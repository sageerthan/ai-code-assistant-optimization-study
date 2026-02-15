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
// 1 <= s.length <= 104
// s consists of parentheses only '()[]{}'.

//Code Structure:

class Solution {

    /**
     * @param String $s
     * @return Boolean
     */
    function isValid($s) {
        $stack = [];
        $mapping = [
            ')' => '(',
            '}' => '{',
            ']' => '['
        ];
        
        for ($i = 0; $i < strlen($s); $i++) {
            $char = $s[$i];
            
            // If it's a closing bracket
            if (array_key_exists($char, $mapping)) {
                // Check if stack is empty or top doesn't match
                if (empty($stack) || array_pop($stack) != $mapping[$char]) {
                    return false;
                }
            } else {
                // It's an opening bracket, push to stack
                array_push($stack, $char);
            }
        }
        
        // Stack should be empty for valid parentheses
        return empty($stack);
    }
}
    