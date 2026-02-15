# https://leetcode.com/problems/minimum-window-substring/
# Problem: Minimum Window Substring

#Problem Description:
#Given two strings s and t of lengths m and n respectively, return the minimum window substring of s such that every character in t (including duplicates) is included in the window. If there is no such substring, return the empty string "".
#The testcases will be generated such that the answer is unique.

# Constraints:
#m == s.length
# n == t.length
# 1 <= m, n <= 10^5
# s and t consist of uppercase and lowercase English letters.

#Code Structure:
class Solution(object):
    def minWindow(self, s, t):
        """
        :type s: str
        :type t: str
        :rtype: str
        """                                                
        t_count = collections.Counter(t)
        required_chars = len(t_count)
        left = 0
        min_length = float('inf')
        min_start = 0
        for right in range(len(s)):
            if s[right] in t_count:
                t_count[s[right]] -= 1
                if t_count[s[right]] == 0:
                    required_chars -= 1
            while required_chars == 0:
                if right - left + 1 < min_length:
                    min_length = right - left + 1
                    min_start = left
                if s[left] in t_count:
                    t_count[s[left]] += 1
                    if t_count[s[left]] > 0:
                        required_chars += 1
                left += 1
        return "" if min_length == float('inf') else s[min_start:min_start + min_length]
    