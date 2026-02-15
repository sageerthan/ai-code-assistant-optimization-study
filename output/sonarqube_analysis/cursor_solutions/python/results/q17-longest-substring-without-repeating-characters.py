# https://leetcode.com/problems/longest-substring-without-repeating-characters/
# Problem: Longest Substring Without Repeating Characters

#Problem Description:
#Given a string s, find the length of the longest substring without duplicate characters.

# Constraints:
# 0 <= s.length <= 5 * 10^4
# s consists of English letters, digits, symbols and spaces.

#Code Structure:

class Solution(object):
    def lengthOfLongestSubstring(self, s):
        """
        :type s: str
        :rtype: int
        """
        char_map = {}
        left = 0
        max_length = 0
        
        for right in range(len(s)):
            char = s[right]
            
            # If character is already in the window, move left pointer
            if char in char_map and char_map[char] >= left:
                left = char_map[char] + 1
            
            # Update character's last seen position
            char_map[char] = right
            
            # Update maximum length
            max_length = max(max_length, right - left + 1)
        
        return max_length 
    