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
            return $n;
        }
        
        $prev2 = 1; // ways to reach step 1
        $prev1 = 2; // ways to reach step 2
        
        for ($i = 3; $i <= $n; $i++) {
            $current = $prev1 + $prev2;
            $prev2 = $prev1;
            $prev1 = $current;
        }
        
        return $prev1;
    }
}
    