<?php
/** https://leetcode.com/problems/group-anagrams */
// Problem: Group Anagrams

//Problem Description:
//Given an array of strings strs, group the anagrams together. You can return the answer in any order.

// Constraints:
// 1 <= strs.length <= 10^4
// 0 <= strs[i].length <= 100
// strs[i] consists of lowercase English letters.

//Code Structure:
class Solution {

    /**
     * @param String[] $strs
     * @return String[][]
     */
    function groupAnagrams($strs) {
        $anagrams = [];

        foreach ($strs as $str) {
            // Sort the string to create a key for the anagram group
            $key = str_split($str);
            sort($key);
            $key = implode('', $key);

            // Group the anagrams using the sorted string as the key
            if (!isset($anagrams[$key])) {
                $anagrams[$key] = [];
            }
            $anagrams[$key][] = $str;
        }

        // Return the grouped anagrams as a 2D array
        return array_values($anagrams);
        
    }
}
    