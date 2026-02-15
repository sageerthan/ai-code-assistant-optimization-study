<?php
/** https://leetcode.com/problems/kth-largest-element-in-an-array */
// Problem: Kth Largest Element in an Array

//Problem Description:
//Given an integer array nums and an integer k, return the kth largest element in the array.
//Note that it is the kth largest element in the sorted order, not the kth distinct element.
//Can you solve it without sorting?

// Constraints:
// 1 <= k <= nums.length <= 10^5
// -10^4 <= nums[i] <= 10^4

//Code Structure:

class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer
     */
    function findKthLargest($nums, $k) {
        // Use a min-heap to keep track of the k largest elements
        $minHeap = new SplMinHeap();
        
        foreach ($nums as $num) {
            $minHeap->insert($num);
            if ($minHeap->count() > $k) {
                $minHeap->extract(); // Remove the smallest element if we exceed k
            }
        }
        
        return $minHeap->top(); // The top of the min-heap is the kth largest element
        
    }
}
    