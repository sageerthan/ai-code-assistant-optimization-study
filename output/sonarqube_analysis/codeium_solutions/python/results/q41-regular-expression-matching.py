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
        sLen, pLen = len(s), len(p)
        dp = [[False] * (pLen + 1) for _ in range(sLen + 1)]
        dp[0][0] = True
        
        for j in range(1, pLen + 1):
            if p[j - 1] == '*':
                dp[0][j] = dp[0][j - 2]
        
        for i in range(1, sLen + 1):
            for j in range(1, pLen + 1):
                if p[j - 1] in {s[i - 1], '.'}:
                    dp[i][j] = dp[i - 1][j - 1]
                elif p[j - 1] == '*':
                    dp[i][j] = dp[i][j - 2] or (dp[i - 1][j] and p[j - 2] in {s[i - 1], '.'})
        
        return dp[sLen][pLen]
    