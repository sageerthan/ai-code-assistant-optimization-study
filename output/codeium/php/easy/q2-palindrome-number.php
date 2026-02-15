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
        $x = (string) $x;
        $left = 0;
        $right = strlen($x) - 1;
        
        while ($left < $right) {
            if ($x[$left] !== $x[$right]) {
                return false;
            }
            $left++;
            $right--;
        }
        return true;
    }
}

    