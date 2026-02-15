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
        $nums = array_merge([1], $nums, [1]);
        $n = count($nums);
        $dp = array_fill(0, $n, array_fill(0, $n, 0));

        for ($len = 2; $len < $n; $len++) {
            for ($i = 0; $i < $n - $len; $i++) {
                $j = $i + $len;
                for ($k = $i + 1; $k < $j; $k++) {
                    $dp[$i][$j] = max($dp[$i][$j], $dp[$i][$k] + $dp[$k][$j] + $nums[$i] * $nums[$k] * $nums[$j]);
                }
            }
        }

        return $dp[0][$n - 1];
    }
}
    