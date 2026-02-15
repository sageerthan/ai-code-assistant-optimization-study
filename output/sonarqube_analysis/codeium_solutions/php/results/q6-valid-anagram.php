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
        if (strlen($s) !== strlen($t)) return false;
        $sCount = array_count_values(str_split($s));
        $tCount = array_count_values(str_split($t));
        return $sCount === $tCount;
    }
}
    