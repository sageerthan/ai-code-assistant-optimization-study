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
        $maxLength = 0;
        $stack = new SplStack();
        $stack->push(-1); // Base index for valid substring

        for ($i = 0; $i < strlen($s); $i++) {
            if ($s[$i] === '(') {
                $stack->push($i);
            } else {
                $stack->pop(); // Pop the last open parenthesis index
                if ($stack->isEmpty()) {
                    $stack->push($i); // Push current index as base
                } else {
                    $maxLength = max($maxLength, $i - $stack->top());
                }
            }
        }

        return $maxLength;
    }
}
    