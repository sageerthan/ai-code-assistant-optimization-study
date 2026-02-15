/** https://leetcode.com/problems/group-anagrams */
// Problem: Group Anagrams

//Problem Description:
//Given an array of strings strs, group the anagrams together. You can return the answer in any order.

// Constraints:
// 1 <= strs.length <= 10^4
// 0 <= strs[i].length <= 100
// strs[i] consists of lowercase English letters.

//Code Structure:

/**
 * @param {string[]} strs
 * @return {string[][]}
 */
var groupAnagrams = function(strs) {
    const anagrams = {};
    for (let str of strs) {
        const sortedStr = str.split('').sort().join('');
        if (anagrams[sortedStr]) {
            anagrams[sortedStr].push(str);
        } else {
            anagrams[sortedStr] = [str];
        }
    }
    return Object.values(anagrams);
};
    