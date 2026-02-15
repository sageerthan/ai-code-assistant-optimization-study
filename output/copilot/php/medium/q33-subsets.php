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

    private function backtrack($nums, $index, $currentSubset, &$result) {
        $result[] = $currentSubset;

        for ($i = $index; $i < count($nums); $i++) {
            $this->backtrack($nums, $i + 1, array_merge($currentSubset, [$nums[$i]]), $result);
        }
    }
}
    