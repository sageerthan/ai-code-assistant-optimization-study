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
        from collections import Counter
        p_count = Counter(p)
        s_count = Counter()
        result = []
        left = 0
        for right, c in enumerate(s):
            s_count[c] += 1
            while s_count[c] > p_count[c]:
                s_count[s[left]] -= 1
                left += 1
            if right - left + 1 == len(p):
                result.append(left)
        return result
    