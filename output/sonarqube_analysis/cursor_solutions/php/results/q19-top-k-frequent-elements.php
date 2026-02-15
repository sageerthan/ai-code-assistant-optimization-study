<?php
/** https://leetcode.com/problems/top-k-frequent-elements */
// Problem: Top K Frequent Elements

//Problem Description:
//Given an integer array nums and an integer k, return the k most frequent elements. You may return the answer in any order.

// Constraints:
// 1 <= nums.length <= 10^5
// -10^4 <= nums[i] <= 10^4
// k is in the range [1, the number of unique elements in the array].
// It is guaranteed that the answer is unique.

//Code Structure:
class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer[]
     */
    function topKFrequent($nums, $k) {
        // Count frequency of each element
        $frequency = [];
        foreach ($nums as $num) {
            $frequency[$num] = ($frequency[$num] ?? 0) + 1;
        }
        
        // Sort by frequency in descending order
        arsort($frequency);
        
        // Get the top k elements
        $result = [];
        $count = 0;
        foreach ($frequency as $num => $freq) {
            if ($count >= $k) break;
            $result[] = $num;
            $count++;
        }
        
        return $result;
    }
}
    