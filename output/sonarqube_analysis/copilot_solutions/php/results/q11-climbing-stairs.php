<?php
/** https://leetcode.com/problems/climbing-stairs */
// Problem: Climbing Stairs

//Problem Description:
//You are climbing a staircase. It takes n steps to reach the top.
//Each time you can either climb 1 or 2 steps. In how many distinct ways can you climb to the top?

// Constraints:
// 1 <= n <= 45

//Code Structure:

class Solution {

    /**
     * @param Integer $n
     * @return Integer
     */
    function climbStairs($n) {
        if ($n <= 2) {
            return $n; // Base cases: 1 step or 2 steps
        }

        $first = 1; // Ways to climb to step 1
        $second = 2; // Ways to climb to step 2
        $ways = 0;

        for ($i = 3; $i <= $n; $i++) {
            $ways = $first + $second; // Current ways is the sum of the previous two
            $first = $second; // Move to the next step
            $second = $ways; // Update second to current ways
        }

        return $ways; // Return the total ways to climb n steps   
    }
}
    