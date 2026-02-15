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
        max_len = 0
        start = 0
        for i, c in enumerate(s):
            if c == '(':
                stack.append(i)
            else:
                if stack == []:
                    start = i + 1
                else:
                    stack.pop()
                    if stack == []:
                        max_len = max(max_len, i - start + 1)
                    else:
                        max_len = max(max_len, i - stack[-1])
        return max_len
    