# https://leetcode.com/problems/find-all-anagrams-in-a-string/
# Problem: Find All Anagrams in a String

#Problem Description:
#Given two strings s and p, return an array of all the start indices of p's anagrams in s. You may return the answer in any order.

# Constraints:
# 1 <= s.length, p.length <= 3 * 10^4
# s and p consist of lowercase English letters.

#Code Structure:
class Solution(object):
    def findAnagrams(self, s, p):
        """
        :type s: str
        :type p: str
        :rtype: List[int]
        """
        if len(s) < len(p):
            return []

        p_count = [0] * 26
        s_count = [0] * 26
        result = []

        for char in p:
            p_count[ord(char) - ord('a')] += 1

        for i in range(len(s)):
            s_count[ord(s[i]) - ord('a')] += 1

            if i >= len(p):
                s_count[ord(s[i - len(p)]) - ord('a')] -= 1

            if p_count == s_count:
                result.append(i - len(p) + 1)

        return result
                       
    