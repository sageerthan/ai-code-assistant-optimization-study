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
    const m = s.length;
    const n = p.length;
    
    // dp[i][j] represents if s[0...i-1] matches p[0...j-1]
    const dp = Array(m + 1).fill().map(() => Array(n + 1).fill(false));
    
    // Empty string matches empty pattern
    dp[0][0] = true;
    
    // Handle patterns like a*, a*b*, a*b*c* that can match empty string
    for (let j = 2; j <= n; j += 2) {
        if (p[j - 1] === '*') {
            dp[0][j] = dp[0][j - 2];
        }
    }
    
    for (let i = 1; i <= m; i++) {
        for (let j = 1; j <= n; j++) {
            const sChar = s[i - 1];
            const pChar = p[j - 1];
            
            if (pChar === '*') {
                // Case 1: '*' matches zero characters
                dp[i][j] = dp[i][j - 2];
                
                // Case 2: '*' matches one or more characters
                if (matches(sChar, p[j - 2])) {
                    dp[i][j] = dp[i][j] || dp[i - 1][j];
                }
            } else if (matches(sChar, pChar)) {
                dp[i][j] = dp[i - 1][j - 1];
            }
        }
    }
    
    return dp[m][n];
};

function matches(sChar, pChar) {
    return pChar === '.' || sChar === pChar;
}
    