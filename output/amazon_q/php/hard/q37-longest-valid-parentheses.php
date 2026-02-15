<?php
/** https://leetcode.com/problems/longest-valid-parentheses */
// Problem: Longest Valid Parentheses

//Problem Description:
//Given a string containing just the characters '(' and ')', return the length of the longest valid (well-formed) parentheses substring.

// Constraints:
// 0 <= s.length <= 3 * 10^4
// s[i] is '(', or ')'.


//Code Structure:
class Solution {

    /**
     * @param String $s
     * @return Integer
     */
    function longestValidParentheses($s) {
        $max = 0;
        $stack = [-1];
        for ($i = 0; $i < strlen($s); $i++) {
            if ($s[$i] == '(') {
                array_push($stack, $i);
            } else {
                array_pop($stack);
                if (empty($stack)) {
                    array_push($stack, $i);
                } else {
                    $max = max($max, $i - end($stack));
                }
            }
        }
        return $max;
    }
}
    