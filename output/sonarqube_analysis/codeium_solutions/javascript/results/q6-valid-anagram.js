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
    if (s.length !== t.length) return false;
    const sCount = {};
    const tCount = {};
    for (let i = 0; i < s.length; i++) {
        sCount[s[i]] = (sCount[s[i]] || 0) + 1;
        tCount[t[i]] = (tCount[t[i]] || 0) + 1;
    }
    for (const c in sCount) if (sCount[c] !== tCount[c]) return false;
    return true;
};
    