<?php
/** https://leetcode.com/problems/maximum-subarray */
// Problem: Maximum Subarray

//Problem Description:
//Given an integer array nums, find the subarray with the largest sum, and return its sum.

// Constraints:
// 1 <= nums.length <= 10^5
// -10^4 <= nums[i] <= 10^4

//Code Structure:

class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function maxSubArray($nums) {
        if (empty($nums)) {
            return 0;
        }
        
        $maxSoFar = $nums[0];
        $maxEndingHere = $nums[0];
        
        for ($i = 1; $i < count($nums); $i++) {
            // Either extend the existing subarray or start a new one
            $maxEndingHere = max($nums[$i], $maxEndingHere + $nums[$i]);
            
            // Update the maximum sum found so far
            $maxSoFar = max($maxSoFar, $maxEndingHere);
        }
        
        return $maxSoFar;
    }
}
    