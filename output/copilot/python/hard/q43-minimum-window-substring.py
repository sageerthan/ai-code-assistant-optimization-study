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
        from collections import Counter

        if not s or not t:
            return ""

        need = Counter(t)
        window = {}
        have = 0
        need_count = len(need)
        res = ""
        res_len = float('inf')
        left = 0

        for right, c in enumerate(s):
            window[c] = window.get(c, 0) + 1
            if c in need and window[c] == need[c]:
                have += 1

            while have == need_count:
                # Update result if this window is smaller
                if (right - left + 1) < res_len:
                    res = s[left:right+1]
                    res_len = right - left + 1

                # Pop from the left of the window
                window[s[left]] -= 1
                if s[left] in need and window[s[left]] < need[s[left]]:
                    have -= 1
                left += 1

        return res
                                              
    