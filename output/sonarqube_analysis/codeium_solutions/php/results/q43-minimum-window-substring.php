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
        $tCount = array_count_values(str_split($t));
        $required = count($tCount);
        
        $left = 0;
        $minLen = PHP_INT_MAX;
        $minStart = 0;
        $formed = 0;
        
        $windowCounts = [];
        
        for ($right = 0; $right < strlen($s); $right++) {
            $character = $s[$right];
            $windowCounts[$character] = ($windowCounts[$character] ?? 0) + 1;
            
            if (isset($tCount[$character]) && $windowCounts[$character] == $tCount[$character]) $formed++;
            
            while ($left <= $right && $formed == $required) {
                $character = $s[$left];
                
                if ($right - $left + 1 < $minLen) {
                    $minLen = $right - $left + 1;
                    $minStart = $left;
                }
                
                $windowCounts[$character]--;
                if (isset($tCount[$character]) && $windowCounts[$character] < $tCount[$character]) $formed--;
                
                $left++; // Try to find a smaller window.
            }
        }
        
        return $minLen === PHP_INT_MAX ? "" : substr($s, $minStart, $minLen);
    }
}
    