<?php
/** https://leetcode.com/problems/intersection-of-two-arrays */
// Problem: Intersection of Two Arrays

//Problem Description:
//Given two integer arrays nums1 and nums2, return an array of their intersection. Each element in the result must be unique and you may return the result in any order.

// // Constraints:
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
        $set1 = array_flip($nums1);
        $set2 = array_flip($nums2);
        $intersection = array_intersect_key($set1, $set2);
        return array_keys($intersection);
    }
}
    