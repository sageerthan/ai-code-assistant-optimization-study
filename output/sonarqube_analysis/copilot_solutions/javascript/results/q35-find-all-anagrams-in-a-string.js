/** https://leetcode.com/problems/find-all-anagrams-in-a-string */
// Problem: Find All Anagrams in a String

//Problem Description:
//Given two strings s and p, return an array of all the start indices of p's anagrams in s. You may return the answer in any order.

// Constraints:
// 1 <= s.length, p.length <= 3 * 10^4
// s and p consist of lowercase English letters.

//Code Structure:
/**
 * @param {string} s
 * @param {string} p
 * @return {number[]}
 */
var findAnagrams = function(s, p) {
    const result = [];
    const pCount = Array(26).fill(0);
    const sCount = Array(26).fill(0);

    for (let i = 0; i < p.length; i++) {
        pCount[p.charCodeAt(i) - 97]++;
        sCount[s.charCodeAt(i) - 97]++;
    }

    if (arraysEqual(pCount, sCount)) {
        result.push(0);
    }

    for (let i = p.length; i < s.length; i++) {
        sCount[s.charCodeAt(i) - 97]++;
        sCount[s.charCodeAt(i - p.length) - 97]--;

        if (arraysEqual(pCount, sCount)) {
            result.push(i - p.length + 1);
        }
    }

    return result;
};

const arraysEqual = (a, b) => {
    for (let i = 0; i < a.length; i++) {
        if (a[i] !== b[i]) return false;
    }
    return true;
};
    