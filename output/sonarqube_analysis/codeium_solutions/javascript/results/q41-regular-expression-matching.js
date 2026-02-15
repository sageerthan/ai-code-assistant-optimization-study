/** https://leetcode.com/problems/regular-expression-matching */
// Problem: Regular Expression Matching

//Problem Description:
//Given an input string s and a pattern p, implement regular expression matching with support for '.' and '*' where:
//'.' Matches any single character.​​​​
//'*' Matches zero or more of the preceding element.
//The matching should cover the entire input string (not partial).

// Constraints:
// 1 <= s.length <= 20
// 1 <= p.length <= 20
// s contains only lowercase English letters.
// p contains only lowercase English letters, '.', and '*'.
// It is guaranteed for each appearance of the character '*', there will be a previous valid character to match.

//Code Structure:

/**
 * @param {string} s
 * @param {string} p
 * @return {boolean}
 */
var isMatch = function(s, p) {
    let dp = Array(s.length + 1).fill(false).map(() => Array(p.length + 1).fill(false));
    dp[0][0] = true;
    for (let j = 1; j <= p.length; j++) {
        if (p[j - 1] === '*') dp[0][j] = dp[0][j - 2];
    }
    for (let i = 1; i <= s.length; i++) {
        for (let j = 1; j <= p.length; j++) {
            if (p[j - 1] === s[i - 1] || p[j - 1] === '.')
                dp[i][j] = dp[i - 1][j - 1];
            else if (p[j - 1] === '*')
                dp[i][j] = dp[i][j - 2] || (dp[i - 1][j] && (p[j - 2] === s[i - 1] || p[j - 2] === '.'));
        }
    }
    return dp[s.length][p.length];
};
    