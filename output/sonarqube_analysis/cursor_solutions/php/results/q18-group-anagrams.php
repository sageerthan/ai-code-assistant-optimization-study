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
        $anagramGroups = [];
        
        foreach ($strs as $str) {
            // Sort characters to create a key for anagrams
            $chars = str_split($str);
            sort($chars);
            $key = implode('', $chars);
            
            // Group strings with the same sorted key
            if (!isset($anagramGroups[$key])) {
                $anagramGroups[$key] = [];
            }
            $anagramGroups[$key][] = $str;
        }
        
        // Return only the values (groups) without the keys
        return array_values($anagramGroups);
    }
}
    