# https://leetcode.com/problems/palindrome-number/

# Problem: Palindrome Number

#Problem Description:
#Given an integer x, return true if x is a palindrome, and false otherwise.

# Constraints:
# -2^31 <= x <= 2^31 - 1

#Code Structure:

class Solution(object):
    def isPalindrome(self, x):
        """
        :type x: int
        :rtype: bool
        """
        # Negative numbers are not palindromes
        if x < 0:
            return False
        
        # Convert to string and check if it reads the same forwards and backwards
        x_str = str(x)
        return x_str == x_str[::-1]
    