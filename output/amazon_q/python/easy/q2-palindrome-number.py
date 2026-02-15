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
        if x < 0:
            return False
        else:
            return str(x) == str(x)[::-1]
        
    