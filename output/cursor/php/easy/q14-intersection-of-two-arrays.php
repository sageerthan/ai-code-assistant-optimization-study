<?php
/** https://leetcode.com/problems/intersection-of-two-arrays */
// Problem: Intersection of Two Arrays

//Problem Description:
//Given two integer arrays nums1 and nums2, return an array of their intersection. Each element in the result must be unique and you may return the result in any order.

// Constraints:
// 1 <= nums1.length, nums2.length <= 1000
// 0 <= nums1[i], nums2[i] <= 1000

//Code Structure:
class Solution {

    /**
     * @param Integer[] $nums1
     * @param Integer[] $nums2
     * @return Integer[]
     */
    function intersection($nums1, $nums2) {
        // Convert nums1 to a set for O(1) lookup
        $set1 = [];
        foreach ($nums1 as $num) {
            $set1[$num] = true;
        }
        
        $result = [];
        $resultSet = [];
        
        // Check each element in nums2
        foreach ($nums2 as $num) {
            // If num exists in nums1 and not already in result
            if (isset($set1[$num]) && !isset($resultSet[$num])) {
                $result[] = $num;
                $resultSet[$num] = true;
            }
        }
        
        return $result;
    }
}
    