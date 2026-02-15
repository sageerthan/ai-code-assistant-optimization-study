/** https://leetcode.com/problems/valid-anagram */
// Problem: Valid Anagram

//Problem Description:
//Given two strings s and t, return true if t is an anagram of s, and false otherwise.

// Constraints:
// 1 <= s.length, t.length <= 5 * 10^4
// s and t consist of lowercase English letters.

//Code Structure:
/**
 * @param {string} s
 * @param {string} t
 * @return {boolean}
 */
var isAnagram = function(s, t) {
    if (s.length !== t.length) {        
        return false;
    }
    const charCount = new Map();
    for (let i = 0; i < s.length; i++) {
        charCount.set(s[i], (charCount.get(s[i]) || 0) + 1);
    }
    for (let i = 0; i < t.length; i++) {
        if (!charCount.has(t[i])) {
            return false;
        }
        charCount.set(t[i], (charCount.get(t[i]) || 0) - 1);
    }
    return Array.from(charCount.values()).every(count => count === 0);
};
    