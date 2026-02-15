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
        $pLength = strlen($p);
        $sLength = strlen($s);
        $pCount = array_fill(0, 26, 0);
        $sCount = array_fill(0, 26, 0);

        if ($pLength > $sLength) {
            return $result;
        }

        for ($i = 0; $i < $pLength; $i++) {
            $pCount[ord($p[$i]) - ord('a')]++;
            $sCount[ord($s[$i]) - ord('a')]++;
        }

        if ($pCount == $sCount) {
            $result[] = 0;
        }

        for ($i = $pLength; $i < $sLength; $i++) {
            $sCount[ord($s[$i]) - ord('a')]++;
            $sCount[ord($s[$i - $pLength]) - ord('a')]--;

            if ($pCount == $sCount) {
                $result[] = $i - $pLength + 1;
            }
        }

        return $result;
    }
}
    