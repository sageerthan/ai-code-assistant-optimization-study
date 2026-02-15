<?php
/** https://leetcode.com/problems/palindrome-number */
// Problem: Palindrome Number

//Problem Description:
//Given an integer x, return true if x is a palindrome, and false otherwise.

// Constraints:
// -2^31 <= x <= 2^31 - 1

//Code Structure:

class Solution {

    /**
     * @param Integer $x
     * @return Boolean
     */
    function isPalindrome($x) {
        // Negative numbers are not palindromes
        if ($x < 0) {
            return false;
        }
        
        // Single digit numbers are palindromes
        if ($x < 10) {
            return true;
        }
        
        // Numbers ending with 0 (except 0 itself) are not palindromes
        if ($x % 10 == 0) {
            return false;
        }
        
        $reversed = 0;
        $original = $x;
        
        // Reverse half of the number
        while ($x > $reversed) {
            $reversed = $reversed * 10 + $x % 10;
            $x = intval($x / 10);
        }
        
        // For even number of digits: x == reversed
        // For odd number of digits: x == reversed / 10 (middle digit doesn't matter)
        return $x == $reversed || $x == intval($reversed / 10);
    }
}

    