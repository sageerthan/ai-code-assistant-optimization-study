<?php
/** https://leetcode.com/problems/missing-number */
// Problem: Missing Number

//Problem Description:
//Given an array nums containing n distinct numbers in the range [0, n], return the only number in the range that is missing from the array.

// Constraints:
// n == nums.length
// 1 <= n <= 104
// 0 <= nums[i] <= n
// All the numbers of nums are unique.

//Code Structure:
class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function missingNumber($nums) {
        $n = count($nums);
        $expectedSum = ($n * ($n + 1)) / 2; // Sum of first n natural numbers
        $actualSum = array_sum($nums);
        return $expectedSum - $actualSum; // The missing number
    }
}
    