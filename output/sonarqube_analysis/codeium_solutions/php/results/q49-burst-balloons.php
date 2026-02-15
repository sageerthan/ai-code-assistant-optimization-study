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
        $dp = array_fill(0, $n + 2, array_fill(0, $n + 2, 0));
        for ($length = 1; $length <= $n; $length++) {
            for ($left = 1; $left <= $n - $length + 1; $left++) {
                $right = $left + $length - 1;
                for ($i = $left; $i <= $right; $i++) {
                    $dp[$left][$right] = max($dp[$left][$right], $dp[$left][$i - 1] + $dp[$i + 1][$right] + $nums[$left - 1] * $nums[$i] * $nums[$right + 1]);
                }
            }
        }
        return $dp[1][$n];
    }
}
    