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
    const pMap = new Map();
    const sMap = new Map();

    // Initialize the frequency map for string p
    for (const char of p) {
        pMap.set(char, (pMap.get(char) || 0) + 1);
    }

    let left = 0;
    let right = 0;

    while (right < s.length) {
        // Expand the window to the right
        sMap.set(s[right], (sMap.get(s[right]) || 0) + 1);

        // Shrink the window from the left if the window size exceeds p.length
        if (right - left + 1 > p.length) {
            sMap.set(s[left], sMap.get(s[left]) - 1);
            if (sMap.get(s[left]) === 0) {
                sMap.delete(s[left]);
            }
            left++;
        }

        // Check if the current window is an anagram of p
        if (right - left + 1 === p.length && compareMaps(sMap, pMap)) {
            result.push(left);
        }

        right++;
    }

    return result;
};
    