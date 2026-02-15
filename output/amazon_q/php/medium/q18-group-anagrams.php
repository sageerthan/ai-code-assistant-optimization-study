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
        $result = [];
        foreach ($strs as $str) {
            $sortedStr = str_split($str);
            sort($sortedStr);
            $sortedStr = implode('', $sortedStr);
            $result[$sortedStr][] = $str;
        }
        return array_values($result);
    }
}
    