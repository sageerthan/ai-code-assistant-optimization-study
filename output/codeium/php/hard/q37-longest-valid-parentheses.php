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
        $length = strlen($s);
        $dp = array_fill(0, $length, 0);
        $max = 0;
        for ($i = 1; $i < $length; $i++) {
            if ($s[$i] == ')') {
                if ($s[$i - 1] == '(') {
                    $dp[$i] = ($i - 2 >= 0) ? $dp[$i - 2] + 2 : 2;
                } elseif ($i - $dp[$i - 1] > 0 && $s[$i - $dp[$i - 1] - 1] == '(') {
                    $dp[$i] = $dp[$i - 1] + ($i - $dp[$i - 1] >= 2 ? $dp[$i - $dp[$i - 1] - 2] : 0) + 2;
                }
                $max = max($max, $dp[$i]);
            }
        }
        return $max;
    }
}
    