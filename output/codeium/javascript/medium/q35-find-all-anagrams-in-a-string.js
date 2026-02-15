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
    const pCount = {};
    const sCount = {};
    const result = [];
    let left = 0, right = 0, count = 0;
    for (let c of p) pCount[c] = (pCount[c] || 0) + 1;
    while (right < s.length) {
        if (pCount[s[right]]) {
            sCount[s[right]] = (sCount[s[right]] || 0) + 1;
            if (sCount[s[right]] <= pCount[s[right]]) count++;
        }
        while (count === p.length) {
            if (right - left + 1 === p.length) result.push(left);
            if (sCount[s[left]] <= pCount[s[left]]) count--;
            sCount[s[left]]--;
            left++;
        }
        right++;
    }
    return result;
};
    