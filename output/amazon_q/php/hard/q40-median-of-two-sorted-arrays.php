<?php
/** https://leetcode.com/problems/median-of-two-sorted-arrays */
// Problem: Median of Two Sorted Arrays

//Problem Description:
//Given two sorted arrays nums1 and nums2 of size m and n respectively, return the median of the two sorted arrays.
//The overall run time complexity should be O(log (m+n)).

// Constraints:
// nums1.length == m
// nums2.length == n
// 0 <= m <= 1000
// 0 <= n <= 1000
// 1 <= m + n <= 2000
// -10^6 <= nums1[i], nums2[i] <= 10^6

//Code Structure:

class Solution {

    /**
     * @param Integer[] $nums1
     * @param Integer[] $nums2
     * @return Float
     */
    function findMedianSortedArrays($nums1, $nums2) {
        $merged = array_merge($nums1, $nums2);
        sort($merged);
        $count = count($merged);
        if ($count % 2 == 0) {
            $middle = $count / 2;
            return ($merged[$middle - 1] + $merged[$middle]) / 2;
        } else {
            $middle = floor($count / 2);
            return $merged[$middle];
        }
    }
}
    