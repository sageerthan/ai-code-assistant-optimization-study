<?php
/** https://leetcode.com/problems/majority-element */
// Problem: Majority Element

//Problem Description:
//Given an array nums of size n, return the majority element.
//The majority element is the element that appears more than ⌊n / 2⌋ times. You may assume that the majority element always exists in the array.

// Constraints:
// n == nums.length
// 1 <= n <= 5 * 10^4
// -10^9 <= nums[i] <= 10^9

//Code Structure:
class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function majorityElement($nums) {
        $count = 0;
        $candidate = null;
        
        foreach ($nums as $num) {
            if ($count === 0) {
                $candidate = $num;
                $count = 1;
            } else if ($candidate === $num) {
                $count++;
            } else {
                $count--;
            }
        }
        return $candidate;
    }
}
    