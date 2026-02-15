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
        $low = 0;
        $mid = 0;
        $high = count($nums) - 1;
        
        while ($mid <= $high) {
            switch ($nums[$mid]) {
                case 0:
                    list($nums[$low], $nums[$mid]) = array($nums[$mid], $nums[$low]);
                    $low++;
                    $mid++;
                    break;
                case 1:
                    $mid++;
                    break;
                case 2:
                    list($nums[$mid], $nums[$high]) = array($nums[$high], $nums[$mid]);
                    $high--;
                    break;
            }
        }
    }
}
    