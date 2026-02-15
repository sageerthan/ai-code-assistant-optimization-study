<?php
/** https://leetcode.com/problems/top-k-frequent-elements */
// Problem: Top K Frequent Elements

//Problem Description:
//Given an integer array nums and an integer k, return the k most frequent elements. You may return the answer in any order.

// Constraints:
// 1 <= nums.length <= 105
// -104 <= nums[i] <= 104
// k is in the range [1, the number of unique elements in the array].
// It is guaranteed that the answer is unique.

//Code Structure:

// First generated code
// class Solution {

//     /**
//      * @param Integer[] $nums
//      * @param Integer $k
//      * @return Integer[]
//      */
//     function topKFrequent($nums, $k) {
//         $map = array_count_values($nums);
//         arsort($map);
//         return array_keys(array_slice($map, 0, $k));
//     }
// }

// Debugged Code

class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer[]
     */
    function topKFrequent($nums, $k) {
        $map = array_count_values($nums);
        uasort($map, function($a, $b) {
            return $b[1] <=> $a[1];
        });
        $result = array_keys(array_slice($map, 0, $k));
        return $result;
    }
}
    