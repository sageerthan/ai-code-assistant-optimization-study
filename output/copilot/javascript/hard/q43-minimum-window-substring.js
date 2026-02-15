/** https://leetcode.com/problems/minimum-window-substring */
// Problem: Minimum Window Substring

//Problem Description:
//Given two strings s and t of lengths m and n respectively, return the minimum window substring of s such that every character in t (including duplicates) is included in the window. If there is no such substring, return the empty string "".
//The testcases will be generated such that the answer is unique.

// Constraints:
//m == s.length
// n == t.length
// 1 <= m, n <= 10^5
// s and t consist of uppercase and lowercase English letters.

//Code Structure:
/**
 * @param {string} s
 * @param {string} t
 * @return {string}
 */
var minWindow = function(s, t) {
    if (s.length < t.length) return ""; // If s is shorter than t, return empty string

    const charCount = {}; // Object to count characters in t
    for (const char of t) {
        charCount[char] = (charCount[char] || 0) + 1; // Count occurrences of each character in t
    }

    let left = 0, right = 0; // Two pointers for the sliding window
    let required = Object.keys(charCount).length; // Number of unique characters in t
    let formed = 0; // Number of unique characters in the current window that match the count in t
    const windowCounts = {}; // Object to count characters in the current window
    let minLength = Infinity; // Minimum length of the valid window found
    let minWindow = ""; // Resulting minimum window substring

    while (right < s.length) {
        const charRight = s[right];
        windowCounts[charRight] = (windowCounts[charRight] || 0) + 1; // Add character to the current window

        if (charCount[charRight] && windowCounts[charRight] === charCount[charRight]) {
            formed++; // If the character count matches, increment formed
        }

        while (left <= right && formed === required) { // Try to contract the window from the left
            const charLeft = s[left];

            if (right - left + 1 < minLength) { // Update minimum length and substring if a smaller valid window is found
                minLength = right - left + 1;
                minWindow = s.substring(left, right + 1);
            }

            windowCounts[charLeft]--; // Remove character from the current window
            if (charCount[charLeft] && windowCounts[charLeft] < charCount[charLeft]) {
                formed--; // If the count goes below required, decrement formed
            }
            left++; // Move left pointer to contract the window
        }
        right++; // Move right pointer to expand the window
    }

    return minWindow; // Return the minimum window substring found   
};
    