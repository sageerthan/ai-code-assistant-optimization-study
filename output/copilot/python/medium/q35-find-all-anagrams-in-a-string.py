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
        s_count = Counter(s[:len(p)])
        result = []
        
        if s_count == p_count:
            result.append(0)
        
        for i in range(len(p), len(s)):
            s_count[s[i]] += 1
            s_count[s[i - len(p)]] -= 1
            
            if s_count[s[i - len(p)]] == 0:
                del s_count[s[i - len(p)]]
            
            if s_count == p_count:
                result.append(i - len(p) + 1)
        
        return result
    