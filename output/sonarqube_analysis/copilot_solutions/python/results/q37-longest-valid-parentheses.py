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
        stack = []
        max_length = 0
        last_invalid_index = -1
        
        for i, char in enumerate(s):
            if char == '(':
                stack.append(i)
            else:
                if stack:
                    stack.pop()
                    if stack:
                        max_length = max(max_length, i - stack[-1])
                    else:
                        max_length = max(max_length, i - last_invalid_index)
                else:
                    last_invalid_index = i
        
        return max_length                             
    