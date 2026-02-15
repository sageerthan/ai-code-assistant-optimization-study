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
        $max = 0;
        $start = 0;
        $map = [];
        for ($i = 0; $i < strlen($s); $i++) {
            if (isset($map[$s[$i]]) && $map[$s[$i]] >= $start) {
                $start = $map[$s[$i]] + 1;
            }
            $map[$s[$i]] = $i;
            $max = max($max, $i - $start + 1);
        }
        return $max;
    }
}
    