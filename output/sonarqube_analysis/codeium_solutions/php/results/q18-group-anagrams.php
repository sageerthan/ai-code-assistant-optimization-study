<?php
/** https://leetcode.com/problems/group-anagrams */
// Problem: Group Anagrams

//Problem Description:
//Given an array of strings strs, group the anagrams together. You can return the answer in any order.

// Constraints:
// 1 <= strs.length <= 104
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
            $sortedStr = $this->sortString($str);
            if (array_key_exists($sortedStr, $anagrams)) {
                $anagrams[$sortedStr][] = $str;
            } else {
                $anagrams[$sortedStr] = [$str];
            }
        }
        return array_values($anagrams);
    }

    private function sortString(string $str): string {
        $arr = str_split($str);
        sort($arr);
        return implode('', $arr);
    }
}
    