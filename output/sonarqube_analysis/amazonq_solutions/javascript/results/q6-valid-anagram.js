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
    // Check if the lengths of the strings are different
    if (s.length !== t.length) {
        return false;
    }

    // Create an object to store the character counts
    const charCount = {};

    // Iterate through the first string and count the characters
    for (let i = 0; i < s.length; i++) {
        const char = s[i];
        charCount[char] = (charCount[char] || 0) + 1;
    }

    // Iterate through the second string and decrement the character counts
    for (let i = 0; i < t.length; i++) {
        const char = t[i];
        if (!charCount[char]) {
            return false;
        }
        charCount[char]--;
    }

    // Check if all character counts are zero
    return Object.values(charCount).every(count => count === 0);
};
    