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
    if (!s || !t || s.length < t.length) {
        return "";
    }
    
    const targetCount = {};
    const windowCount = {};
    
    // Count characters in target string t
    for (const char of t) {
        targetCount[char] = (targetCount[char] || 0) + 1;
    }
    
    let left = 0, right = 0;
    let minLen = Infinity;
    let minStart = 0;
    const required = Object.keys(targetCount).length;
    let formed = 0;
    
    while (right < s.length) {
        const rightChar = s[right];
        windowCount[rightChar] = (windowCount[rightChar] || 0) + 1;
        
        // Check if current character satisfies the requirement
        if (targetCount[rightChar] && 
            windowCount[rightChar] === targetCount[rightChar]) {
            formed++;
        }
        
        // Try to contract the window from the left
        while (left <= right && formed === required) {
            const leftChar = s[left];
            
            // Update minimum window if current window is smaller
            if (right - left + 1 < minLen) {
                minLen = right - left + 1;
                minStart = left;
            }
            
            // Remove character from left side of window
            windowCount[leftChar]--;
            if (targetCount[leftChar] && 
                windowCount[leftChar] < targetCount[leftChar]) {
                formed--;
            }
            
            left++;
        }
        
        right++;
    }
    
    return minLen === Infinity ? "" : s.substring(minStart, minStart + minLen);
};
    