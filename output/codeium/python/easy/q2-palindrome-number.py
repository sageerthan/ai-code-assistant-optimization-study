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
        
        reversed_num = 0
        original_num = x
        while x > 0:
            pop = x % 10
            x //= 10
            reversed_num = reversed_num * 10 + pop
        return reversed_num == original_num
        
    