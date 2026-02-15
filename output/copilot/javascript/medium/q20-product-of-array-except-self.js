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

/**
 * @param {number[]} nums
 * @return {number[]}
 */
var productExceptSelf = function(nums) {
    const n = nums.length; // Get the length of the input array
    const answer = new Array(n).fill(1); // Initialize the answer array with 1s

    // Calculate the prefix products
    for (let i = 1; i < n; i++) {
        answer[i] = answer[i - 1] * nums[i - 1];
    }

    // Calculate the suffix products and multiply with prefix products
    let suffixProduct = 1;
    for (let i = n - 2; i >= 0; i--) {
        suffixProduct *= nums[i + 1];
        answer[i] *= suffixProduct;
    }

    return answer; // Return the final answer array 
};
    