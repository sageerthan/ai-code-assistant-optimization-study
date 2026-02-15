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
        char_set = set()
        left = 0
        max_length = 0

        for right in range(len(s)):
            while s[right] in char_set:
                char_set.remove(s[left])
                left += 1
            char_set.add(s[right])
            max_length = max(max_length, right - left + 1)

        return max_length                                                                    
    