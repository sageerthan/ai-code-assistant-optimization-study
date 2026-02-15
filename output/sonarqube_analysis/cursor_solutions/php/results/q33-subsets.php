<?php
/** https://leetcode.com/problems/subsets */
// Problem: Subsets

//Problem Description:
//Given an integer array nums of unique elements, return all possible subsets (the power set).
//The solution set must not contain duplicate subsets. Return the solution in any order.

// Constraints:
// 1 <= nums.length <= 10
// -10 <= nums[i] <= 10
// All the numbers of nums are unique.

//Code Structure:

class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function subsets($nums) {
        $result = [];
        $this->backtrack($nums, 0, [], $result);
        return $result;
    }
    
    private function backtrack($nums, $start, $current, &$result) {
        // Add current subset to result
        $result[] = $current;
        
        // Try adding each remaining element
        for ($i = $start; $i < count($nums); $i++) {
            $current[] = $nums[$i];
            $this->backtrack($nums, $i + 1, $current, $result);
            array_pop($current); // backtrack
        }
    }
}
    