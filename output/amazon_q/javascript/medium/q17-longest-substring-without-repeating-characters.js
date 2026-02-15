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
    const charIndexMap = new Map();
    let maxLength = 0;
    let start = 0;

    for (let end = 0; end < s.length; end++) {
        const currentChar = s[end];

        if (charIndexMap.has(currentChar)) {
            start = Math.max(start, charIndexMap.get(currentChar) + 1);
        }

        charIndexMap.set(currentChar, end);
        maxLength = Math.max(maxLength, end - start + 1);
    }

    return maxLength;
};
    