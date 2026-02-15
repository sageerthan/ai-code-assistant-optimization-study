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
        result = []
        s_len = len(s)
        p_len = len(p)
        
        if p_len > s_len:
            return result
        
        # Count characters in p
        p_count = [0] * 26
        for char in p:
            p_count[ord(char) - ord('a')] += 1
        
        # Count characters in first window of s
        s_count = [0] * 26
        for i in range(p_len):
            s_count[ord(s[i]) - ord('a')] += 1
        
        # Check if first window is an anagram
        if self.arrays_equal(s_count, p_count):
            result.append(0)
        
        # Slide the window
        for i in range(p_len, s_len):
            # Remove leftmost character
            s_count[ord(s[i - p_len]) - ord('a')] -= 1
            # Add new character
            s_count[ord(s[i]) - ord('a')] += 1
            
            # Check if current window is an anagram
            if self.arrays_equal(s_count, p_count):
                result.append(i - p_len + 1)
        
        return result
    
    def arrays_equal(self, arr1, arr2):
        for i in range(26):
            if arr1[i] != arr2[i]:
                return False
        return True
    