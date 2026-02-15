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
        if (empty($digits)) return [];
        
        $mapping = ["", "", "abc", "def", "ghi", "jkl", "mno", "pqrs", "tuv", "wxyz"];
        $result = [];
        $this->backtrack($result, "", $digits, 0, $mapping);
        return $result;
    }
    
    private function backtrack(&$result, $current, $digits, $index, $mapping) {
        if ($index == strlen($digits)) {
            $result[] = $current;
            return;
        }
        
        $digit = intval($digits[$index]);
        $letters = $mapping[$digit];
        for ($i = 0; $i < strlen($letters); $i++) {
            $this->backtrack($result, $current . $letters[$i], $digits, $index + 1, $mapping);
        }
    }
}
    