<?php
/** https://leetcode.com/problems/trapping-rain-water */
// Problem: Trapping Rain Water

//Problem Description:
//Given n non-negative integers representing an elevation map where the width of each bar is 1, compute how much water it can trap after raining.

// Constraints:
// n == height.length
// 1 <= n <= 2 * 10^4
// 0 <= height[i] <= 10^5

//Code Structure:
class Solution {

    /**
     * Calculates how much water can be trapped after raining.
     * Uses two-pointer approach for O(n) time and O(1) space.
     * @param Integer[] $height
     * @return Integer
     */
    function trap($height) {
        $n = count($height);
        if ($n <= 2) return 0;

        $left = 0;
        $right = $n - 1;
        $leftMax = 0;
        $rightMax = 0;
        $water = 0;

        while ($left < $right) {
            if ($height[$left] < $height[$right]) {
                if ($height[$left] >= $leftMax) {
                    $leftMax = $height[$left];
                } else {
                    $water += $leftMax - $height[$left];
                }
                $left++;
            } else {
                if ($height[$right] >= $rightMax) {
                    $rightMax = $height[$right];
                } else {
                    $water += $rightMax - $height[$right];
                }
                $right--;
            }
        }

        return $water;
    }
}




