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

// First generated code

// class Solution {

//     /**
//      * @param Integer[] $nums
//      * @return NULL
//      */
//     function sortColors(&$nums) {
//         $count = array_count_values($nums);
//         $nums = array_fill(0, $count[0], 0) + array_fill(0, $count[1], 1) + array_fill(0, $count[2], 2);
//     }
// }

//  Debugged Code

class Solution {

    /**
     * @param Integer[] $nums
     * @return NULL
     */
    function sortColors(&$nums) {
        $count = array_count_values($nums);
        $count[0] = $count[0] ?? 0;
        $count[1] = $count[1] ?? 0;
        $count[2] = $count[2] ?? 0;
        
        $index = 0;
        for ($i = 0; $i < $count[0]; $i++) {
            $nums[$index++] = 0;
        }
        for ($i = 0; $i < $count[1]; $i++) {
            $nums[$index++] = 1;
        }
        for ($i = 0; $i < $count[2]; $i++) {
            $nums[$index++] = 2;
        }
    }
}
    