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
        sCount = {}
        tCount = {}
        for c1, c2 in zip(s, t):
            sCount[c1] = sCount.get(c1, 0) + 1
            tCount[c2] = tCount.get(c2, 0) + 1
        for c in sCount:
            if sCount[c] != tCount.get(c, 0):
                return False
        return True
    