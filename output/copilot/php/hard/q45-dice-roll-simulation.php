<?php
/** https://leetcode.com/problems/dice-roll-simulation */
// Problem: Dice Roll Simulation

//Problem Description:
//A die simulator generates a random number from 1 to 6 for each roll. You introduced a constraint to the generator such that it cannot roll the number i more than rollMax[i] (1-indexed) consecutive times.
//Given an array of integers rollMax and an integer n, return the number of distinct sequences that can be obtained with exact n rolls. Since the answer may be too large, return it modulo 109 + 7.
//Two sequences are considered different if at least one element differs from each other.

// Constraints:
// 1 <= n <= 5000
// rollMax.length == 6
// 1 <= rollMax[i] <= 15

//Code Structure:

// First generated code:

// class Solution {

//     /**
//      * @param Integer $n
//      * @param Integer[] $rollMax
//      * @return Integer
//      */
//     function dieSimulator($n, $rollMax) {
//         $MOD = 1000000007;
//         // dp[pos][last][cnt]: ways to roll from pos, last face was 'last', appeared 'cnt' times consecutively
//         $dp = [];

//         // Helper function for DP
//         function dfs($pos, $last, $cnt, $n, &$rollMax, &$dp, $MOD) {
//             if ($pos == $n) return 1;
//             if (isset($dp[$pos][$last][$cnt])) return $dp[$pos][$last][$cnt];
//             $res = 0;
//             for ($face = 0; $face < 6; $face++) {
//                 if ($face == $last) {
//                     if ($cnt + 1 <= $rollMax[$face]) {
//                         $res = ($res + dfs($pos + 1, $face, $cnt + 1, $n, $rollMax, $dp, $MOD)) % $MOD;
//                     }
//                 } else {
//                     $res = ($res + dfs($pos + 1, $face, 1, $n, $rollMax, $dp, $MOD)) % $MOD;
//                 }
//             }
//             return $dp[$pos][$last][$cnt] = $res;
//         }

//         return dfs(0, -1, 0, $n, $rollMax, $dp, $MOD);
//     }
// }
    
// Debugged Code:

class Solution {

    /**
     * @param Integer $n
     * @param Integer[] $rollMax
     * @return Integer
     */
    function dieSimulator($n, $rollMax) {
        $MOD = 1000000007;
        $dp = [];
        return $this->dfs(0, -1, 0, $n, $rollMax, $dp, $MOD);
    }

    /**
     * Helper function for DP using memoization
     * @param Integer $pos
     * @param Integer $last
     * @param Integer $cnt
     * @param Integer $n
     * @param Integer[] $rollMax
     * @param Integer[][][] $dp
     * @param Integer $MOD
     * @return Integer
     */
    private function dfs($pos, $last, $cnt, $n, &$rollMax, &$dp, $MOD) {
        if ($pos == $n) return 1;
        if (isset($dp[$pos][$last][$cnt])) return $dp[$pos][$last][$cnt];
        $res = 0;
        for ($face = 0; $face < 6; $face++) {
            if ($face == $last) {
                if ($cnt + 1 <= $rollMax[$face]) {
                    $res = ($res + $this->dfs($pos + 1, $face, $cnt + 1, $n, $rollMax, $dp, $MOD)) % $MOD;
                }
            } else {
                $res = ($res + $this->dfs($pos + 1, $face, 1, $n, $rollMax, $dp, $MOD)) % $MOD;
            }
        }
        return $dp[$pos][$last][$cnt] = $res;
    }
}
    