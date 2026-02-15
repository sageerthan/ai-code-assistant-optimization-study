<?php
/** https://leetcode.com/problems/contains-duplicate */
// Problem: Contains Duplicate

//Problem Description:
//Given an integer array nums, return true if any value appears at least twice in the array, and return false if every element is distinct.

// Constraints:
// 1 <= nums.length <= 10^5
// -10^9 <= nums[i] <= 10^9

//Code Structure:
class Solution {

    /**
     * @param Integer[] $nums
     * @return Boolean
     */
    function containsDuplicate($nums) {
        // Create an associative array to track occurrences of each number
        $numCount = [];
        
        // Iterate through the array
        foreach ($nums as $num) {
            // If the number is already in the associative array, return true
            if (isset($numCount[$num])) {
                return true;
            }
            // Otherwise, add the number to the associative array
            $numCount[$num] = 1;
        }
        
        // If no duplicates were found, return false
        return false;  
    }
}
    