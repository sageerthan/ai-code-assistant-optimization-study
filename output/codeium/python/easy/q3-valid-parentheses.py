# https://leetcode.com/problems/valid-parentheses/
# Problem: Valid Parentheses

#Problem Description:
#Given a string s containing just the characters '(', ')', '{', '}', '[' and ']', determine if the input string is valid.
#An input string is valid if:
#Open brackets must be closed by the same type of brackets.
#Open brackets must be closed in the correct order.
#Every close bracket has a corresponding open bracket of the same type.

# Constraints:
# 1 <= s.length <= 10^4
# s consists of parentheses only '()[]{}'.

#Code Structure:

class Solution(object):
    def isValid(self, s):
        """
        :type s: str
        :rtype: bool
        """      
        stack = []
        mapping = {')': '(', '}': '{', ']': '['}
        for c in s:
            if c in mapping.values():
                stack.append(c)
            elif c in mapping:
                if not stack or stack.pop() != mapping[c]:
                    return False
        return not stack
    