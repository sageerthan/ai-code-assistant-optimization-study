<?php
/** https://leetcode.com/problems/minimum-window-substring */
// Problem: Minimum Window Substring

//Problem Description:
//Given two strings s and t of lengths m and n respectively, return the minimum window substring of s such that every character in t (including duplicates) is included in the window. If there is no such substring, return the empty string "".
//The testcases will be generated such that the answer is unique.

// Constraints:
//m == s.length
// n == t.length
// 1 <= m, n <= 10^5
// s and t consist of uppercase and lowercase English letters.

//Code Structure:

class Solution {

    /**
     * @param String $s
     * @param String $t
     * @return String
     */
    function minWindow($s, $t) {
        $need = [];
        $window = [];
        $tLen = strlen($t);
        $sLen = strlen($s);

        // Count characters needed from t
        for ($i = 0; $i < $tLen; $i++) {
            $c = $t[$i];
            if (!isset($need[$c])) $need[$c] = 0;
            $need[$c]++;
        }

        $left = 0;
        $right = 0;
        $valid = 0;
        $start = 0;
        $minLen = PHP_INT_MAX;

        while ($right < $sLen) {
            $c = $s[$right];
            $right++;
            if (isset($need[$c])) {
                if (!isset($window[$c])) $window[$c] = 0;
                $window[$c]++;
                if ($window[$c] == $need[$c]) {
                    $valid++;
                }
            }

            // Try to shrink the window from the left
            while ($valid == count($need)) {
                if ($right - $left < $minLen) {
                    $start = $left;
                    $minLen = $right - $left;
                }
                $d = $s[$left];
                $left++;
                if (isset($need[$d])) {
                    if ($window[$d] == $need[$d]) {
                        $valid--;
                    }
                    $window[$d]--;
                }
            }
        }

        return $minLen == PHP_INT_MAX ? "" : substr($s, $start, $minLen);
    }
}