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
            if (isset($charMap[$s[$right]])) {
                $left = max($left, $charMap[$s[$right]] + 1);
            }
            $charMap[$s[$right]] = $right;
            $maxLength = max($maxLength, $right - $left + 1);
        }

        return $maxLength;
    }
}

    