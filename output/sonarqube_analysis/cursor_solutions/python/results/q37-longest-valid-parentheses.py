# https://leetcode.com/problems/longest-valid-parentheses/
# Problem: Longest Valid Parentheses

#Problem Description:
#Given a string containing just the characters '(' and ')', return the length of the longest valid (well-formed) parentheses substring.

# Constraints:
# 0 <= s.length <= 3 * 10^4
# s[i] is '(', or ')'.

#Code Structure:
class Solution(object):
    def longestValidParentheses(self, s):
        """
        :type s: str
        :rtype: int
        """
        if not s:
            return 0
        
        stack = [-1]  # Initialize with -1 to handle edge cases
        max_length = 0
        
        for i, char in enumerate(s):
            if char == '(':
                stack.append(i)
            else:  # char == ')'
                stack.pop()
                if not stack:
                    # No matching opening bracket, update the base
                    stack.append(i)
                else:
                    # Calculate the length of valid parentheses
                    max_length = max(max_length, i - stack[-1])
        
        return max_length
    