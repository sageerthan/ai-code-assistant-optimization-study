# https://leetcode.com/problems/regular-expression-matching/
# Problem: Regular Expression Matching

#Problem Description:
#Given an input string s and a pattern p, implement regular expression matching with support for '.' and '*' where:
#'.' Matches any single character.​​​​
#'*' Matches zero or more of the preceding element.
#The matching should cover the entire input string (not partial).

# Constraints:
# 1 <= s.length <= 20
# 1 <= p.length <= 20
# s contains only lowercase English letters.
# p contains only lowercase English letters, '.', and '*'.
# It is guaranteed for each appearance of the character '*', there will be a previous valid character to match.

#Code Structure:

class Solution(object):
    def isMatch(self, s, p):
        """
        :type s: str
        :type p: str
        :rtype: bool
        """
        m, n = len(s), len(p)
        dp = [[False] * (n + 1) for _ in range(m + 1)]
        
        # Empty string matches empty pattern
        dp[0][0] = True
        
        # Handle patterns like a*, a*b*, a*b*c*
        for j in range(2, n + 1):
            if p[j - 1] == '*':
                dp[0][j] = dp[0][j - 2]
        
        for i in range(1, m + 1):
            for j in range(1, n + 1):
                if p[j - 1] == '*':
                    # Case 1: '*' matches zero characters
                    dp[i][j] = dp[i][j - 2]
                    # Case 2: '*' matches one or more characters
                    if self.matches(s, p, i - 1, j - 2):
                        dp[i][j] = dp[i][j] or dp[i - 1][j]
                else:
                    # Direct character match
                    if self.matches(s, p, i - 1, j - 1):
                        dp[i][j] = dp[i - 1][j - 1]
        
        return dp[m][n]
    
    def matches(self, s, p, i, j):
        """
        Helper function to check if characters match
        """
        if j < 0:
            return False
        return p[j] == '.' or s[i] == p[j]
    