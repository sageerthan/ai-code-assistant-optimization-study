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
        $sLen = strlen($s);
        $tLen = strlen($t);
        
        if ($sLen < $tLen) {
            return "";
        }
        
        // Count characters in t
        $tCount = [];
        for ($i = 0; $i < $tLen; $i++) {
            $char = $t[$i];
            $tCount[$char] = ($tCount[$char] ?? 0) + 1;
        }
        
        $left = 0;
        $right = 0;
        $windowCount = [];
        $formed = 0;
        $required = count($tCount);
        $minLen = PHP_INT_MAX;
        $minLeft = 0;
        
        while ($right < $sLen) {
            // Add character from right
            $char = $s[$right];
            $windowCount[$char] = ($windowCount[$char] ?? 0) + 1;
            
            // Check if this character completes a requirement
            if (isset($tCount[$char]) && $windowCount[$char] === $tCount[$char]) {
                $formed++;
            }
            
            // Try to contract window from left
            while ($left <= $right && $formed === $required) {
                $char = $s[$left];
                
                // Update minimum window
                if ($right - $left + 1 < $minLen) {
                    $minLen = $right - $left + 1;
                    $minLeft = $left;
                }
                
                // Remove character from left
                $windowCount[$char]--;
                if (isset($tCount[$char]) && $windowCount[$char] < $tCount[$char]) {
                    $formed--;
                }
                
                $left++;
            }
            
            $right++;
        }
        
        return $minLen === PHP_INT_MAX ? "" : substr($s, $minLeft, $minLen);
    }
}
    