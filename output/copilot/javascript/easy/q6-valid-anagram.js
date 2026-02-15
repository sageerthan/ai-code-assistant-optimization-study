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
        return false; // If lengths differ, they cannot be anagrams
    }

    const charCount = new Array(26).fill(0); // Array to count character occurrences

    for (let i = 0; i < s.length; i++) {
        charCount[s.charCodeAt(i) - 'a'.charCodeAt(0)]++; // Increment count for character in s
        charCount[t.charCodeAt(i) - 'a'.charCodeAt(0)]--; // Decrement count for character in t
    }

    // Check if all counts are zero
    return charCount.every(count => count === 0);  
};
    