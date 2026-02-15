<?php
/** https://leetcode.com/problems/product-of-array-except-self */
// Problem: Product of Array Except Self

//Problem Description:
//Given an integer array nums, return an array answer such that answer[i] is equal to the product of all the elements of nums except nums[i].
//The product of any prefix or suffix of nums is guaranteed to fit in a 32-bit integer.
//You must write an algorithm that runs in O(n) time and without using the division operation.

// Constraints:
// 2 <= nums.length <= 10^5
// -30 <= nums[i] <= 30
// The input is generated such that answer[i] is guaranteed to fit in a 32-bit integer.

//Code Structure:

class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[]
     */
    function productExceptSelf($nums) {
        $n = count($nums);
        $result = array_fill(0, $n, 1);
        
        // Calculate left products
        for ($i = 1; $i < $n; $i++) {
            $result[$i] = $result[$i - 1] * $nums[$i - 1];
        }
        
        // Calculate right products and multiply with left products
        $rightProduct = 1;
        for ($i = $n - 1; $i >= 0; $i--) {
            $result[$i] *= $rightProduct;
            $rightProduct *= $nums[$i];
        }
        
        return $result;
    }
}
    