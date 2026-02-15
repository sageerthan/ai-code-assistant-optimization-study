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
    const set = new Set();
    let i = 0, j = 0, max = 0;
    while (j < s.length) {
        if (!set.has(s.charAt(j))) {
            set.add(s.charAt(j));
            j++;
            max = Math.max(max, j - i);
        } else {
            set.delete(s.charAt(i));
            i++;
        }
    }
    return max;
};
    