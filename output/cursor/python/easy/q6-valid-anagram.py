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
        # If lengths are different, they can't be anagrams
        if len(s) != len(t):
            return False
        
        # Count characters in both strings
        char_count = {}
        
        # Count characters in string s
        for char in s:
            char_count[char] = char_count.get(char, 0) + 1
        
        # Subtract characters from string t
        for char in t:
            if char not in char_count:
                return False
            char_count[char] -= 1
            if char_count[char] == 0:
                del char_count[char]
        
        # If all characters are matched, char_count should be empty
        return len(char_count) == 0
    