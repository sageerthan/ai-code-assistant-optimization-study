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
        $dp = array_fill(0, strlen($s) + 1, false);
        $dp[0] = true;

        for ($i = 1; $i <= strlen($s); $i++) {
            for ($j = 0; $j < $i; $j++) {
                if ($dp[$j] && in_array(substr($s, $j, $i - $j), $wordDict)) {
                    $dp[$i] = true;
                    break;
                }
            }
        }

        return $dp[strlen($s)];
    }
}
    