<?php
/** https://leetcode.com/problems/find-all-anagrams-in-a-string */
// Problem: Find All Anagrams in a String

//Problem Description:
//Given two strings s and p, return an array of all the start indices of p's anagrams in s. You may return the answer in any order.

// Constraints:
// 1 <= s.length, p.length <= 3 * 10^4
// s and p consist of lowercase English letters.

//Code Structure:
class Solution {

    /**
     * @param String $s
     * @param String $p
     * @return Integer[]
     */
    function findAnagrams($s, $p) {
        $result = [];
        $sLen = strlen($s);
        $pLen = strlen($p);
        
        if ($pLen > $sLen) {
            return $result;
        }
        
        // Count characters in pattern p
        $pCount = array_fill(0, 26, 0);
        for ($i = 0; $i < $pLen; $i++) {
            $pCount[ord($p[$i]) - ord('a')]++;
        }
        
        // Count characters in first window of s
        $sCount = array_fill(0, 26, 0);
        for ($i = 0; $i < $pLen; $i++) {
            $sCount[ord($s[$i]) - ord('a')]++;
        }
        
        // Check if first window is an anagram
        if ($this->arraysEqual($sCount, $pCount)) {
            $result[] = 0;
        }
        
        // Slide the window
        for ($i = $pLen; $i < $sLen; $i++) {
            // Remove leftmost character
            $sCount[ord($s[$i - $pLen]) - ord('a')]--;
            
            // Add rightmost character
            $sCount[ord($s[$i]) - ord('a')]++;
            
            // Check if current window is an anagram
            if ($this->arraysEqual($sCount, $pCount)) {
                $result[] = $i - $pLen + 1;
            }
        }
        
        return $result;
    }
    
    private function arraysEqual($arr1, $arr2) {
        for ($i = 0; $i < 26; $i++) {
            if ($arr1[$i] != $arr2[$i]) {
                return false;
            }
        }
        return true;
    }
}
    