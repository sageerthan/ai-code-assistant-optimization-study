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
        
        digit_to_char = {
            '2': 'abc', '3': 'def', '4': 'ghi', '5': 'jkl',
            '6': 'mno', '7': 'pqrs', '8': 'tuv', '9': 'wxyz'
        }
        
        def backtrack(index, path):
            if index == len(digits):
                combinations.append("".join(path))
                return
            
            possible_chars = digit_to_char[digits[index]]
            for char in possible_chars:
                path.append(char)
                backtrack(index + 1, path)
                path.pop()
        
        combinations = []
        backtrack(0, [])
        return combinations   
    