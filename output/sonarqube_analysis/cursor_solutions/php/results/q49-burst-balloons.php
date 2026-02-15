<?php
/** https://leetcode.com/problems/burst-balloons */
// Problem: Burst Balloons

//Problem Description:
//You are given n balloons, indexed from 0 to n - 1. Each balloon is painted with a number on it represented by an array nums. You are asked to burst all the balloons.
//If you burst the ith balloon, you will get nums[i - 1] * nums[i] * nums[i + 1] coins. If i - 1 or i + 1 goes out of bounds of the array, then treat it as if there is a balloon with a 1 painted on it.
//Return the maximum coins you can collect by bursting the balloons wisely.

// Constraints:
// n == nums.length
// 1 <= n <= 300
// 0 <= nums[i] <= 100

//Code Structure:

class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function maxCoins($nums) {
        $n = count($nums);
        
        // Add boundary balloons with value 1
        $balloons = [1];
        foreach ($nums as $num) {
            $balloons[] = $num;
        }
        $balloons[] = 1;
        $m = count($balloons);
        
        // dp[i][j] = maximum coins from bursting balloons between i and j (exclusive)
        $dp = array_fill(0, $m, array_fill(0, $m, 0));
        
        // Fill dp for different lengths
        for ($len = 2; $len < $m; $len++) {
            for ($left = 0; $left < $m - $len; $left++) {
                $right = $left + $len;
                
                // Try each balloon as the last one to burst in this range
                for ($k = $left + 1; $k < $right; $k++) {
                    $coins = $balloons[$left] * $balloons[$k] * $balloons[$right];
                    $coins += $dp[$left][$k] + $dp[$k][$right];
                    $dp[$left][$right] = max($dp[$left][$right], $coins);
                }
            }
        }
        
        return $dp[0][$m - 1];
    }
}
    