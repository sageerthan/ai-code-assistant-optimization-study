<?php
/** https://leetcode.com/problems/valid-anagram */
// Problem: Valid Anagram

//Problem Description:
//Given two strings s and t, return true if t is an anagram of s, and false otherwise.

// Constraints:
// 1 <= s.length, t.length <= 5 * 10^4
// s and t consist of lowercase English letters.

//Code Structure:
class Solution {

    /**
     * @param String $s
     * @param String $t
     * @return Boolean
     */
    function isAnagram($s, $t) {
        // If lengths are different, they can't be anagrams
        if (strlen($s) !== strlen($t)) {
            return false;
        }
        
        // Count character frequencies in both strings
        $charCount = [];
        
        // Count characters in string s
        for ($i = 0; $i < strlen($s); $i++) {
            $char = $s[$i];
            $charCount[$char] = ($charCount[$char] ?? 0) + 1;
        }
        
        // Subtract character counts from string t
        for ($i = 0; $i < strlen($t); $i++) {
            $char = $t[$i];
            if (!isset($charCount[$char]) || $charCount[$char] <= 0) {
                return false;
            }
            $charCount[$char]--;
        }
        
        // Check if all counts are zero
        foreach ($charCount as $count) {
            if ($count !== 0) {
                return false;
            }
        }
        
        return true;
    }
}
    