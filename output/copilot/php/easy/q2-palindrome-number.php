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
        
        // Convert the number to a string
        $str = (string)$x;
        
        // Check if the string is equal to its reverse
        return $str === strrev($str); 
    }
}

    