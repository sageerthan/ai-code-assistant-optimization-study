/** https://leetcode.com/problems/minimum-window-substring */
// Problem: Minimum Window Substring

//Problem Description:
//Given two strings s and t of lengths m and n respectively, return the minimum window substring of s such that every character in t (including duplicates) is included in the window. If there is no such substring, return the empty string "".
//The testcases will be generated such that the answer is unique.

// Constraints:
//m == s.length
// n == t.length
// 1 <= m, n <= 10^5
// s and t consist of uppercase and lowercase English letters.

//Code Structure:

// First generated code

/**
 * @param {string} s
 * @param {string} t
 * @return {string}
 */
var minWindow = function(s, t) {
    const tCount = {};
    for (let c of t) {
        tCount[c] = (tCount[c] || 0) + 1;
    }
    let left = 0, minLen = Infinity, minStart = 0, formed = 0;
    const windowCounts = {};
    for (let right = 0; right < s.length; right++) {
        const character = s[right];
        windowCounts[character] = (windowCounts[character] || 0) + 1;
        if (tCount[character] && windowCounts[character] === tCount[character]) formed++;
        while (left <= right && formed === Object.keys(tCount).length) {
            character = s[left];
            if (right - left + 1 < minLen) {
                minLen = right - left + 1;
                minStart = left;
            }
            windowCounts[character]--;
            if (tCount[character] && windowCounts[character] < tCount[character]) formed--;
            left++;
        }
    }
    return minLen === Infinity ? "" : s.substring(minStart, minStart + minLen);
};

// Debugged Code

//Code Structure:
/**
 * @param {string} s
 * @param {string} t
 * @return {string}
 */
var minWindow = function(s, t) {
    const tCount = {};
    for (let c of t) {
        tCount[c] = (tCount[c] || 0) + 1;
    }
    let left = 0, minLen = Infinity, minStart = 0, formed = 0;
    const windowCounts = {};
    for (let right = 0; right < s.length; right++) {
        const rightChar = s[right];
        windowCounts[rightChar] = (windowCounts[rightChar] || 0) + 1;
        if (tCount[rightChar] && windowCounts[rightChar] === tCount[rightChar]) formed++;
        while (left <= right && formed === Object.keys(tCount).length) {
            const leftChar = s[left];
            if (right - left + 1 < minLen) {
                minLen = right - left + 1;
                minStart = left;
            }
            windowCounts[leftChar]--;
            if (tCount[leftChar] && windowCounts[leftChar] < tCount[leftChar]) formed--;
            left++;
        }
    }
    return minLen === Infinity ? "" : s.substring(minStart, minStart + minLen);
};
    