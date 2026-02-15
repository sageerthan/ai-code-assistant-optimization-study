<?php
/** https://leetcode.com/problems/binary-search */
// Problem: Binary Search

//Problem Description:
//Given an array of integers nums which is sorted in ascending order, and an integer target, write a function to search target in nums. If target exists, then return its index. Otherwise, return -1.
//You must write an algorithm with O(log n) runtime complexity.

// Constraints:
// 1 <= nums.length <= 10^4
// -10^4 < nums[i], target < 10^4
// All the integers in nums are unique.
// nums is sorted in ascending order.

//Code Structure:

class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer
     */
    function search($nums, $target) {
        $left = 0;
        $right = count($nums) - 1;

        while ($left <= $right) {
            $mid = (int)(($left + $right) / 2);

            if ($nums[$mid] === $target) {
                return $mid; // Target found, return index
            } elseif ($nums[$mid] < $target) {
                $left = $mid + 1; // Search in the right half
            } else {
                $right = $mid - 1; // Search in the left half
            }
        }
        return -1; // Target not found   
    }
}
    