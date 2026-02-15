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
        // If lengths are not equal, they cannot be anagrams
        if (strlen($s) !== strlen($t)) {
            return false;
        }

        // Count characters in both strings
        $countS = array_count_values(str_split($s));
        $countT = array_count_values(str_split($t));

        // Compare character counts
        foreach ($countS as $char => $count) {
            if (!isset($countT[$char]) || $countT[$char] !== $count) {
                return false;
            }
        }

        return true; // All character counts match
        
    }
}
    