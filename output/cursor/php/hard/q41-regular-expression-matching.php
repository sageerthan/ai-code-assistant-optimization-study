<?php
/** https://leetcode.com/problems/regular-expression-matching */
// Problem: Regular Expression Matching

//Problem Description:
//Given an input string s and a pattern p, implement regular expression matching with support for '.' and '*' where:
//'.' Matches any single character.​​​​
//'*' Matches zero or more of the preceding element.
//The matching should cover the entire input string (not partial).

// Constraints:
// 1 <= s.length <= 20
// 1 <= p.length <= 20
// s contains only lowercase English letters.
// p contains only lowercase English letters, '.', and '*'.
// It is guaranteed for each appearance of the character '*', there will be a previous valid character to match.

//Code Structure:

class Solution {

    /**
     * @param String $s
     * @param String $p
     * @return Boolean
     */
    function isMatch($s, $p) {
        $m = strlen($s);
        $n = strlen($p);
        
        // dp[i][j] represents if s[0...i-1] matches p[0...j-1]
        $dp = array_fill(0, $m + 1, array_fill(0, $n + 1, false));
        
        // Empty string matches empty pattern
        $dp[0][0] = true;
        
        // Handle patterns like a*, a*b*, a*b*c* etc.
        for ($j = 2; $j <= $n; $j += 2) {
            if ($p[$j - 1] === '*') {
                $dp[0][$j] = $dp[0][$j - 2];
            }
        }
        
        for ($i = 1; $i <= $m; $i++) {
            for ($j = 1; $j <= $n; $j++) {
                if ($p[$j - 1] === '*') {
                    // Case 1: * matches zero characters
                    $dp[$i][$j] = $dp[$i][$j - 2];
                    
                    // Case 2: * matches one or more characters
                    if ($this->matches($s, $p, $i - 1, $j - 2)) {
                        $dp[$i][$j] = $dp[$i][$j] || $dp[$i - 1][$j];
                    }
                } else {
                    // Direct character match
                    if ($this->matches($s, $p, $i - 1, $j - 1)) {
                        $dp[$i][$j] = $dp[$i - 1][$j - 1];
                    }
                }
            }
        }
        
        return $dp[$m][$n];
    }
    
    private function matches($s, $p, $i, $j) {
        if ($j < 0) {
            return false;
        }
        
        return $p[$j] === '.' || $s[$i] === $p[$j];
    }
}
    