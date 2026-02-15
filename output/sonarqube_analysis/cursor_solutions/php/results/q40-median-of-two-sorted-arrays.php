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
        // Ensure nums1 is the smaller array
        if (count($nums1) > count($nums2)) {
            return $this->findMedianSortedArrays($nums2, $nums1);
        }
        
        $m = count($nums1);
        $n = count($nums2);
        $left = 0;
        $right = $m;
        
        while ($left <= $right) {
            $partitionX = intval(($left + $right) / 2);
            $partitionY = intval(($m + $n + 1) / 2) - $partitionX;
            
            $maxLeftX = ($partitionX == 0) ? PHP_INT_MIN : $nums1[$partitionX - 1];
            $minRightX = ($partitionX == $m) ? PHP_INT_MAX : $nums1[$partitionX];
            
            $maxLeftY = ($partitionY == 0) ? PHP_INT_MIN : $nums2[$partitionY - 1];
            $minRightY = ($partitionY == $n) ? PHP_INT_MAX : $nums2[$partitionY];
            
            if ($maxLeftX <= $minRightY && $maxLeftY <= $minRightX) {
                // Found the correct partition
                if (($m + $n) % 2 == 0) {
                    return (max($maxLeftX, $maxLeftY) + min($minRightX, $minRightY)) / 2;
                } else {
                    return max($maxLeftX, $maxLeftY);
                }
            } else if ($maxLeftX > $minRightY) {
                $right = $partitionX - 1;
            } else {
                $left = $partitionX + 1;
            }
        }
        
        return 0.0;
    }
}
    