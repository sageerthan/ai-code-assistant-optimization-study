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

class Solution {
    public boolean isMatch(String s, String p) {
        // Create a 2D boolean array to store the results of subproblems
        boolean[][] dp = new boolean[s.length() + 1][p.length() + 1];
        // Initialize the first row and column of the dp array
        dp[0][0] = true;
        for (int i = 1; i <= p.length(); i++) {
            if (p.charAt(i - 1) == '*') {
                dp[0][i] = dp[0][i - 2];
            }
        }
        // Loop through each character in the string s
        for (int i = 1; i <= s.length(); i++) {
            // Loop through each character in the pattern p
            for (int j = 1; j <= p.length(); j++) {
                // If the current characters match or the pattern character is a wildcard
                if (s.charAt(i - 1) == p.charAt(j - 1) || p.charAt(j - 1) == '.') {
                    dp[i][j] = dp[i - 1][j - 1];
                }
                // If the pattern character is a wildcard
                else if (p.charAt(j - 1) == '*') {
                    dp[i][j] = dp[i][j - 2];
                    if (p.charAt(j - 2) == '.' || p.charAt(j - 2) == s.charAt(i - 1)) {
                        dp[i][j] = dp[i][j] | dp[i - 1][j];
                    }
                }
            }
        }
        // Return the result of the entire problem
        return dp[s.length()][p.length()];
    }
}
    