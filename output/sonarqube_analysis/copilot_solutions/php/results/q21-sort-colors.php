<?php
/** https://leetcode.com/problems/sort-colors */
// Problem: Sort Colors

//Problem Description:
//Given an array nums with n objects colored red, white, or blue, sort them in-place so that objects of the same color are adjacent, with the colors in the order red, white, and blue.
//We will use the integers 0, 1, and 2 to represent the color red, white, and blue, respectively.
//You must solve this problem without using the library's sort function.

// Constraints:
// n == nums.length
// 1 <= n <= 300
// nums[i] is either 0, 1, or 2.

//Code Structure:

class Solution {

    /**
     * @param Integer[] $nums
     * @return NULL
     */
    function sortColors(&$nums) {
        $low = 0; // Pointer for the next position of 0
        $mid = 0; // Pointer for the current element
        $high = count($nums) - 1; // Pointer for the next position of 2

        while ($mid <= $high) {
            if ($nums[$mid] === 0) {
                // Swap nums[low] and nums[mid], increment both pointers
                list($nums[$low], $nums[$mid]) = array($nums[$mid], $nums[$low]);
                $low++;
                $mid++;
            } elseif ($nums[$mid] === 1) {
                // Just move the mid pointer
                $mid++;
            } else {
                // Swap nums[mid] and nums[high], decrement high pointer
                list($nums[$mid], $nums[$high]) = array($nums[$high], $nums[$mid]);
                $high--;
            }
        }
        
    }
}
    