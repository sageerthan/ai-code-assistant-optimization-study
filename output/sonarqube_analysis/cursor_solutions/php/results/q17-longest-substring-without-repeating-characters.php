<?php
/** https://leetcode.com/problems/longest-substring-without-repeating-characters */
// Problem: Longest Substring Without Repeating Characters

//Problem Description:
//Given a string s, find the length of the longest substring without duplicate characters.

// Constraints:
// 0 <= s.length <= 5 * 10^4
// s consists of English letters, digits, symbols and spaces.

//Code Structure:

class Solution {

    /**
     * @param String $s
     * @return Integer
     */
    function lengthOfLongestSubstring($s) {
        $charMap = [];
        $left = 0;
        $maxLength = 0;
        
        for ($right = 0; $right < strlen($s); $right++) {
            $char = $s[$right];
            
            // If character is already in the window, move left pointer
            if (isset($charMap[$char]) && $charMap[$char] >= $left) {
                $left = $charMap[$char] + 1;
            }
            
            // Update character's last seen position
            $charMap[$char] = $right;
            
            // Update maximum length
            $maxLength = max($maxLength, $right - $left + 1);
        }
        
        return $maxLength;
    }
}
    