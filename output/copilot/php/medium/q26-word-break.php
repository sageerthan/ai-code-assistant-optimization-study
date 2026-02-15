<?php
/** https://leetcode.com/problems/word-break */
// Problem: Word Break

//Problem Description:
//Given a string s and a dictionary of strings wordDict, return true if s can be segmented into a space-separated sequence of one or more dictionary words.
//Note that the same word in the dictionary may be reused multiple times in the segmentation.

// Constraints:
// 1 <= s.length <= 300
// 1 <= wordDict.length <= 1000
// 1 <= wordDict[i].length <= 20
// s and wordDict[i] consist of only lowercase English letters.
// All the strings of wordDict are unique.

//Code Structure:

class Solution {

    /**
     * @param String $s
     * @param String[] $wordDict
     * @return Boolean
     */
    function wordBreak($s, $wordDict) {
        $wordSet = array_flip($wordDict); // Convert wordDict to a set for O(1) lookups
        $n = strlen($s);
        $dp = array_fill(0, $n + 1, false);
        $dp[0] = true; // Base case: empty string can always be segmented

        for ($i = 1; $i <= $n; $i++) {
            for ($j = 0; $j < $i; $j++) {
                if ($dp[$j] && isset($wordSet[substr($s, $j, $i - $j)])) {
                    $dp[$i] = true;
                    break; // No need to check further if we found a valid segmentation
                }
            }
        }

        return $dp[$n]; // Return whether the entire string can be segmented
    }
}
    