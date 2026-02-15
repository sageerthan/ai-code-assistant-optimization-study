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

class Solution {

    /**
     * @param Integer $n
     * @param Integer[] $rollMax
     * @return Integer
     */
    function dieSimulator($n, $rollMax) {
        $mod = 1000000007;
        
        // dp[i][j][k] = number of sequences of length i ending with j consecutive k's
        $dp = array_fill(0, $n + 1, array_fill(0, 7, array_fill(0, 16, 0)));
        
        // Base case: empty sequence
        for ($j = 0; $j < 6; $j++) {
            $dp[0][$j][0] = 1;
        }
        
        for ($i = 1; $i <= $n; $i++) {
            for ($j = 0; $j < 6; $j++) {
                for ($k = 1; $k <= $rollMax[$j]; $k++) {
                    // Continue the same number
                    $dp[$i][$j][$k] = $dp[$i - 1][$j][$k - 1];
                }
                
                // Start with a different number
                for ($prev = 0; $prev < 6; $prev++) {
                    if ($prev !== $j) {
                        for ($prevK = 0; $prevK <= $rollMax[$prev]; $prevK++) {
                            $dp[$i][$j][1] = ($dp[$i][$j][1] + $dp[$i - 1][$prev][$prevK]) % $mod;
                        }
                    }
                }
            }
        }
        
        $result = 0;
        for ($j = 0; $j < 6; $j++) {
            for ($k = 1; $k <= $rollMax[$j]; $k++) {
                $result = ($result + $dp[$n][$j][$k]) % $mod;
            }
        }
        
        return $result;
    }
}
    