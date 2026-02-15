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
        $dp = array_fill(0, $n + 1, array_fill(0, 6, array_fill(0, 16, 0)));
        $dp[0][0][0] = 1;

        for ($i = 1; $i <= $n; $i++) {
            for ($j = 0; $j < 6; $j++) {
                for ($k = 1; $k <= $rollMax[$j]; $k++) {
                    if ($k > $i) {
                        continue;
                    }
                    for ($l = 0; $l < 6; $l++) {
                        if ($l != $j) {
                            $dp[$i][$j][$k] = ($dp[$i][$j][$k] + $dp[$i - 1][$l][1]) % $mod;
                        } else {
                            $dp[$i][$j][$k] = ($dp[$i][$j][$k] + $dp[$i - 1][$l][$k - 1]) % $mod;
                        }
                    }
                }
            }
        }

        $result = 0;
        for ($i = 0; $i < 6; $i++) {
            $result = ($result + $dp[$n][$i][$rollMax[$i]]) % $mod;
        }

        return $result;
    }
}
    