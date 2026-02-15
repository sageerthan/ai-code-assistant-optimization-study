<?php
/** https://leetcode.com/problems/find-all-anagrams-in-a-string */
// Problem: Find All Anagrams in a String

//Problem Description:
//Given two strings s and p, return an array of all the start indices of p's anagrams in s. You may return the answer in any order.

// Constraints:
// 1 <= s.length, p.length <= 3 * 10^4
// s and p consist of lowercase English letters.

//Code Structure:

// First generated code

// class Solution {

//     /**
//      * @param String $s
//      * @param String $p
//      * @return Integer[]
//      */
//     function findAnagrams($s, $p) {
//         $result = [];
//         $pCount = array_count_values(str_split($p));
//         $sCount = [];
//         $left = 0, $right = 0, $count = 0;
//         while ($right < strlen($s)) {
//             if (isset($pCount[$s[$right]]) && $pCount[$s[$right]] > 0) {
//                 $sCount[$s[$right]] = (isset($sCount[$s[$right]]) ? $sCount[$s[$right]] : 0) + 1;
//                 if ($sCount[$s[$right]] <= $pCount[$s[$right]]) $count++;
//             }
//             while ($count == strlen($p)) {
//                 if ($right - $left + 1 == strlen($p)) $result[] = $left;
//                 if (isset($pCount[$s[$left]]) && $pCount[$s[$left]] > 0) {
//                     $sCount[$s[$left]]--;
//                     if ($sCount[$s[$left]] < $pCount[$s[$left]]) $count--;
//                 }
//                 $left++;
//             }
//             $right++;
//         }
//         return $result;
//     }
// }

// Debugged Code

class Solution {

    /**
     * @param String $s
     * @param String $p
     * @return Integer[]
     */
    function findAnagrams($s, $p) {
        $result = [];
        $pCount = array_count_values(str_split($p));
        $sCount = [];
        $left = 0;
        $right = 0;
        $count = 0;
        while ($right < strlen($s)) {
            if (isset($pCount[$s[$right]]) && $pCount[$s[$right]] > 0) {
                $sCount[$s[$right]] = isset($sCount[$s[$right]]) ? $sCount[$s[$right]] + 1 : 1;
                if ($sCount[$s[$right]] <= $pCount[$s[$right]]) $count++;
            }
            while ($count == strlen($p)) {
                if ($right - $left + 1 == strlen($p)) $result[] = $left;
                if (isset($pCount[$s[$left]]) && $pCount[$s[$left]] > 0) {
                    $sCount[$s[$left]]--;
                    if ($sCount[$s[$left]] < $pCount[$s[$left]]) $count--;
                }
                $left++;
            }
            $right++;
        }
        return $result;
    }
}
    