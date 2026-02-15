<?php
/** https://leetcode.com/problems/letter-combinations-of-a-phone-number */
// Problem: Letter Combinations of a Phone Number

//Problem Description:
//Given a string containing digits from 2-9 inclusive, return all possible letter combinations that the number could represent. Return the answer in any order.
//A mapping of digits to letters (just like on the telephone buttons) is given below. Note that 1 does not map to any letters.

// Constraints:
// 0 <= digits.length <= 4
// digits[i] is a digit in the range ['2', '9'].

//Code Structure:

class Solution {

    /**
     * @param String $digits
     * @return String[]
     */
    function letterCombinations($digits) {
        if (empty($digits)) {
            return []; // Return an empty array for empty input
        }

        $digitToLetters = [
            '2' => 'abc',
            '3' => 'def',
            '4' => 'ghi',
            '5' => 'jkl',
            '6' => 'mno',
            '7' => 'pqrs',
            '8' => 'tuv',
            '9' => 'wxyz'
        ];

        $result = [];
        $this->backtrack($digits, 0, '', $digitToLetters, $result);
        return $result;
        
    }

    private function backtrack($digits, $index, $currentCombination, $digitToLetters, &$result) {
        if ($index === strlen($digits)) {
            $result[] = $currentCombination;
            return;
        }

        $currentDigit = $digits[$index];
        if (isset($digitToLetters[$currentDigit])) {
            $letters = $digitToLetters[$currentDigit];
            for ($i = 0; $i < strlen($letters); $i++) {
                $this->backtrack($digits, $index + 1, $currentCombination . $letters[$i], $digitToLetters, $result);
            }
        }
    }
}
    