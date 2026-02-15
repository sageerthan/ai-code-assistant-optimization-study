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
        if($x < 0){
            return false;
        }
        $reverse = 0;
        $temp = $x;
        while($temp > 0){
            $reverse = $reverse * 10 + $temp % 10;
            $temp = (int)($temp / 10);
        }
        return $x == $reverse;
    }
}

    