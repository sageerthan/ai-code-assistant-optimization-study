<?php
/** https://leetcode.com/problems/valid-parentheses */
// Problem: Valid Parentheses

//Problem Description:
//Given a string s containing just the characters '(', ')', '{', '}', '[' and ']', determine if the input string is valid.
//An input string is valid if:
//Open brackets must be closed by the same type of brackets.
//Open brackets must be closed in the correct order.
//Every close bracket has a corresponding open bracket of the same type.

// Constraints:
// 1 <= s.length <= 10^4
// s consists of parentheses only '()[]{}'.

//Code Structure:

class Solution {

    /**
     * @param String $s
     * @return Boolean
     */
    function isValid($s) {
        $stack = [];
        $map = [
            ')' => '(',
            ']' => '[',
            '}' => '{'
        ];
        for ($i = 0; $i < strlen($s); $i++) {
            $char = $s[$i];
            if (!isset($map[$char])) {
                array_push($stack, $char);
            } else {
                if (empty($stack) || $stack[count($stack) - 1] !== $map[$char]) {
                    return false;
                }
                array_pop($stack);
            }
        }
        return empty($stack);
    }
}
    