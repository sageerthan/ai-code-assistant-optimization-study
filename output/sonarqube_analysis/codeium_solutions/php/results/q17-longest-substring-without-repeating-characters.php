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
        $length = strlen($s);
        $charSet = array_fill(0, 256, -1);
        $maxLen = 0;
        $left = $right = 0;

        while ($right < $length) {
            $char = ord($s[$right]);
            if ($charSet[$char] === -1 || $charSet[$char] < $left) {
                $maxLen = max($maxLen, $right - $left + 1);
                $charSet[$char] = $right;
            } else {
                $left = $charSet[$char] + 1;
                $charSet[$char] = $right;
            }
            $right++;
        }

        return $maxLen;
    }
}
    