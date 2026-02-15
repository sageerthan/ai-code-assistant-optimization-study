<?php
/** https://leetcode.com/problems/find-all-anagrams-in-a-string */
// Problem: Find All Anagrams in a String

//Problem Description:
//Given two strings s and p, return an array of all the start indices of p's anagrams in s. You may return the answer in any order.

// Constraints:
// 1 <= s.length, p.length <= 3 * 10^4
// s and p consist of lowercase English letters.

//Code Structure:

// First generated code:

// class Solution {

//     /**
//      * @param String $s
//      * @param String $p
//      * @return Integer[]
//      */
//     function findAnagrams($s, $p) {
//         $result = [];
//         $sLength = strlen($s);
//         $pLength = strlen($p);

//         if ($sLength < $pLength) {
//             return $result; // No anagrams possible
//         }

//         // Count frequency of characters in p
//         $pCount = array_fill(0, 26, 0);
//         for ($i = 0; $i < $pLength; $i++) {
//             $pCount[ord($p[$i]) - ord('a')]++;
//         }

//         // Sliding window to count frequency of characters in s
//         $sCount = array_fill(0, 26, 0);
//         for ($i = 0; $i < $pLength; $i++) {
//             $sCount[ord($s[$i]) - ord('a')]++;
//         }

//         // Check for anagram at the first window
//         if ($this->isAnagram($sCount, $pCount)) {
//             $result[] = 0;
//         }

//         // Slide the window across s
//         for ($i = $pLength; $i < $sLength; $i++) {
//             // Add new character to the window
//             $sCount[ord($s[$i]) - ord('a')]++;
//             // Remove the character that is no longer in the window
//             $sCount[ord($s[$i - $pLength]) - ord('a')]--;

//             // Check if current window is an anagram
//             if ($this->isAnagram($sCount, $pCount)) {
//                 $result[] = $i - $pLength + 1;
//             }
//         }

//         return $result;
        
//     }
// }
    

// Debugged Code:

class Solution {

    /**
     * @param String $s
     * @param String $p
     * @return Integer[]
     */
    function findAnagrams($s, $p) {
        $result = [];
        $sLength = strlen($s);
        $pLength = strlen($p);

        if ($sLength < $pLength) {
            return $result; // No anagrams possible
        }

        // Count frequency of characters in p
        $pCount = array_fill(0, 26, 0);
        for ($i = 0; $i < $pLength; $i++) {
            $pCount[ord($p[$i]) - ord('a')]++;
        }

        // Sliding window to count frequency of characters in s
        $sCount = array_fill(0, 26, 0);
        for ($i = 0; $i < $pLength; $i++) {
            $sCount[ord($s[$i]) - ord('a')]++;
        }

        // Check for anagram at the first window
        if ($this->isAnagram($sCount, $pCount)) {
            $result[] = 0;
        }

        // Slide the window across s
        for ($i = $pLength; $i < $sLength; $i++) {
            // Add new character to the window
            $sCount[ord($s[$i]) - ord('a')]++;
            // Remove the character that is no longer in the window
            $sCount[ord($s[$i - $pLength]) - ord('a')]--;

            // Check if current window is an anagram
            if ($this->isAnagram($sCount, $pCount)) {
                $result[] = $i - $pLength + 1;
            }
        }

        return $result;
        
    }

    /**
     * Helper function to check if two character frequency arrays are equal
     * @param Integer[] $sCount
     * @param Integer[] $pCount
     * @return Boolean
     */
    private function isAnagram($sCount, $pCount) {
        for ($i = 0; $i < 26; $i++) {
            if ($sCount[$i] !== $pCount[$i]) {
                return false;
            }
        }
        return true;
    }
}
    