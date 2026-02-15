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
        char_index = {}
        left = 0
        max_length = 0

        for right, char in enumerate(s):
            if char in char_index and char_index[char] >= left:
                left = char_index[char] + 1
            
            char_index[char] = right
            max_length = max(max_length, right - left + 1)

        return max_length                                                                    
    