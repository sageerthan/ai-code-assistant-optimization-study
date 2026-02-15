<?php
/** https://leetcode.com/problems/burst-balloons */
// Problem: Burst Balloons

// Problem Description:
// You are given n balloons, indexed from 0 to n - 1. Each balloon is painted with a number on it represented by an array nums. You are asked to burst all the balloons.
// If you burst the ith balloon, you will get nums[i - 1] * nums[i] * nums[i + 1] coins. If i - 1 or i + 1 goes out of bounds of the array, then treat it as if there is a balloon with a 1 painted on it.
// Return the maximum coins you can collect by bursting the balloons wisely.

// Constraints:
// n == nums.length
// 1 <= n <= 300
// 0 <= nums[i] <= 100

// Code Structure:

// First generated code:

// class Solution {

//     /**
//      * Calculate the maximum coins you can collect by bursting the balloons wisely.
//      * Uses dynamic programming with memoization.
//      * @param Integer[] $nums
//      * @return Integer
//      */
//     function maxCoins($nums) {
//         // Add 1 to both ends to handle boundaries
//         $n = count($nums);
//         $arr = array_merge([1], $nums, [1]);
//         $dp = [];

//         // Helper function for DP
//         function burst(&$arr, &$dp, $left, $right) {
//             if ($left + 1 == $right) return 0;
//             if (isset($dp[$left][$right])) return $dp[$left][$right];
//             $maxCoins = 0;
//             for ($i = $left + 1; $i < $right; $i++) {
//                 $coins = $arr[$left] * $arr[$i] * $arr[$right];
//                 $coins += burst($arr, $dp, $left, $i);
//                 $coins += burst($arr, $dp, $i, $right);
//                 if ($coins > $maxCoins) $maxCoins = $coins;
//             }
//             $dp[$left][$right] = $maxCoins;
//             return $maxCoins;
//         }

//         return burst($arr, $dp, 0, $n + 1);
//     }
// }

// Debugged Code:

class Solution {

    /**
     * Calculate the maximum coins you can collect by bursting the balloons wisely.
     * Uses dynamic programming with memoization.
     * @param Integer[] $nums
     * @return Integer
     */
    function maxCoins($nums) {
        // Add 1 to both ends to handle boundaries
        $n = count($nums);
        $this->arr = array_merge([1], $nums, [1]);
        $this->dp = [];
        return $this->burst(0, $n + 1);
    }

    /**
     * Helper function for DP using memoization to calculate max coins
     * @param Integer $left
     * @param Integer $right
     * @return Integer
     */
    private function burst($left, $right) {
        if ($left + 1 == $right) return 0;
        if (isset($this->dp[$left][$right])) return $this->dp[$left][$right];
        $maxCoins = 0;
        for ($i = $left + 1; $i < $right; $i++) {
            $coins = $this->arr[$left] * $this->arr[$i] * $this->arr[$right];
            $coins += $this->burst($left, $i);
            $coins += $this->burst($i, $right);
            if ($coins > $maxCoins) $maxCoins = $coins;
        }
        $this->dp[$left][$right] = $maxCoins;
        return $maxCoins;
    }
}