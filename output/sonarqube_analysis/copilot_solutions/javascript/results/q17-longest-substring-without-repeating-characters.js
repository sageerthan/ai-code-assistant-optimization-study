/** https://leetcode.com/problems/longest-substring-without-repeating-characters */
// Problem: Longest Substring Without Repeating Characters

//Problem Description:
//Given a string s, find the length of the longest substring without duplicate characters.

// Constraints:
// 0 <= s.length <= 5 * 10^4
// s consists of English letters, digits, symbols and spaces.

//Code Structure:
/**
 * @param {string} s
 * @return {number}
 */
var lengthOfLongestSubstring = function(s) {
    const charIndexMap = new Map(); // Map to store the last index of each character
    let maxLength = 0; // Variable to track the maximum length of substring
    let start = 0; // Start index of the current substring

    for (let i = 0; i < s.length; i++) {
        const char = s[i];

        // If the character is already in the map and its index is within the current substring
        if (charIndexMap.has(char) && charIndexMap.get(char) >= start) {
            start = charIndexMap.get(char) + 1; // Move the start index to the right of the last occurrence
        }

        charIndexMap.set(char, i); // Update the last index of the character
        maxLength = Math.max(maxLength, i - start + 1); // Update maxLength if needed
    }

    return maxLength; // Return the maximum length of substring without repeating characters    
};
    