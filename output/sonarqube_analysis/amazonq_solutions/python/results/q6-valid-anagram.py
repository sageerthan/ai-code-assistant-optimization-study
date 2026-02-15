# https://leetcode.com/problems/valid-anagram/
# Problem: Valid Anagram

#Problem Description:
#Given two strings s and t, return true if t is an anagram of s, and false otherwise.

# Constraints:
# 1 <= s.length, t.length <= 5 * 10^4
# s and t consist of lowercase English letters.

#Code Structure:
class Solution(object):
    def isAnagram(self, s, t):
        """
        :type s: str
        :type t: str
        :rtype: bool
        """
        if len(s) != len(t):
            return False
        s = sorted(s)
        t = sorted(t)
        for i in range(len(s)):
            if s[i] != t[i]:
                return False
        return True                   
    