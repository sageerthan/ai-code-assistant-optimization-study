# https://leetcode.com/problems/letter-combinations-of-a-phone-number/
# Problem: Letter Combinations of a Phone Number

#Problem Description:
#Given a string containing digits from 2-9 inclusive, return all possible letter combinations that the number could represent. Return the answer in any order.
#A mapping of digits to letters (just like on the telephone buttons) is given below. Note that 1 does not map to any letters.

# Constraints:
# 0 <= digits.length <= 4
# digits[i] is a digit in the range ['2', '9'].

#Code Structure:

class Solution(object):
    def letterCombinations(self, digits):
        """
        :type digits: str
        :rtype: List[str]
        """
        if not digits:
            return []

        phone = {
            '2': ['a', 'b', 'c'],
            '3': ['d', 'e', 'f'],
            '4': ['g', 'h', 'i'],
            '5': ['j', 'k', 'l'],
            '6': ['m', 'n', 'o'],
            '7': ['p', 'q', 'r', 's'],
            '8': ['t', 'u', 'v'],
            '9': ['w', 'x', 'y', 'z']
        }

        result = []
        self.dfs(result, '', digits, phone)
        return result

    def dfs(self, result, current, remaining, phone):
        if not remaining:
            result.append(current)
            return

        for letter in phone[remaining[0]]:
            self.dfs(result, current + letter, remaining[1:], phone)
    