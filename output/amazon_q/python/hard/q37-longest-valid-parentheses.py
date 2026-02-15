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
        stack = [-1]
        max_len = 0
        
        for i in range(len(s)):
            if s[i] == '(':
                stack.append(i)
            else:
                stack.pop()
                if not stack:
                    stack.append(i)
                else:
                    max_len = max(max_len, i - stack[-1])
        
        return max_len
    