<?php
/** https://leetcode.com/problems/maximum-subarray */
// Problem: Maximum Subarray

//Problem Description:
//Given an integer array nums, find the subarray with the largest sum, and return its sum.

// Constraints:
// 1 <= nums.length <= 10^5
// -10^4 <= nums[i] <= 10^4

//Code Structure:

// First generated code

// class Solution {

//     /**
//      * @param Integer[] $nums
//      * @return Integer
//      */
//     function maxSubArray($nums) {
//         $maxSum = $nums[0];
//         $currentSum = $nums[0];

//         for ($i = 1; $i < count($nums); $i++) {
//             $currentSum = max($nums[$i], $currentSum + $nums[$i]);
//             $maxSum = max($maxSum, $currentSum);
//         }

//         return $maxSum;
//     }
// }
    
// Debugged Code

class Solution {
    function maxSubArray($nums) {
        $maxSum = $nums[0];
        $currentSum = $nums[0];
        
        for ($i = 1; $i < count($nums); $i++) {
            $currentSum = max($nums[$i], $currentSum + $nums[$i]);
            $maxSum = max($maxSum, $currentSum);
        }
        
        return $maxSum;
    }
}