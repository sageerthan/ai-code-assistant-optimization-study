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

// First generated code

// class Solution {

//     /**
//      * @param Integer[] $nums
//      * @param Integer $k
//      * @return Integer
//      */
//     function findKthLargest($nums, $k) {
//         $heap = new SplHeap();
//         foreach ($nums as $num) {
//             $heap->insert($num);
//         }
//         for ($i = 0; $i < $k - 1; $i++) {
//             $heap->extract();
//         }
//         return $heap->extract();
//     }
// }

//Debugged Code

class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer
     */
    function findKthLargest($nums, $k) {
        $heap = new SplMinHeap();
        foreach ($nums as $num) {
            $heap->insert($num);
        }
        for ($i = 0; $i < $k - 1; $i++) {
            $heap->extract();
        }
        return $heap->top();
    }
}

// Driver Code
$solution = new Solution();
$nums = [3,2,1,5,6,4];
$k = 2;
echo $solution->findKthLargest($nums, $k);
    