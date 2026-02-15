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
     * @param Integer[] $height
     * @return Integer
     */
    function trap($height) {
        $left = 0;
        $right = count($height) - 1;
        $leftMax = 0;
        $rightMax = 0;
        $result = 0;

        while ($left < $right) {
            if ($height[$left] < $height[$right]) {
                if ($height[$left] >= $leftMax) {
                    $leftMax = $height[$left];
                } else {
                    $result += $leftMax - $height[$left];
                }
                $left++;
            } else {
                if ($height[$right] >= $rightMax) {
                    $rightMax = $height[$right];
                } else {
                    $result += $rightMax - $height[$right];
                }
                $right--;
            }
        }

        return $result;
    }
}
    