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
        if not s or not t:
            return ""
        
        # Count characters in t
        dict_t = {}
        for char in t:
            dict_t[char] = dict_t.get(char, 0) + 1
        
        required = len(dict_t)
        left = right = 0
        formed = 0
        
        # Dictionary to keep track of characters in current window
        window_counts = {}
        
        # Result variables
        ans = float('inf'), None, None
        
        while right < len(s):
            # Add character from right to window
            char = s[right]
            window_counts[char] = window_counts.get(char, 0) + 1
            
            # If frequency of current character matches desired count
            if char in dict_t and window_counts[char] == dict_t[char]:
                formed += 1
            
            # Try to contract window from left
            while left <= right and formed == required:
                char = s[left]
                
                # Save the smallest window until now
                if right - left + 1 < ans[0]:
                    ans = (right - left + 1, left, right)
                
                # Remove character from left of window
                window_counts[char] -= 1
                if char in dict_t and window_counts[char] < dict_t[char]:
                    formed -= 1
                
                left += 1
            
            right += 1
        
        return "" if ans[0] == float('inf') else s[ans[1]:ans[2] + 1]
    