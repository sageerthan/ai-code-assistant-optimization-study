/** https://leetcode.com/problems/maximum-subarray */
// Problem: Maximum Subarray

//Problem Description:
//Given an integer array nums, find the subarray with the largest sum, and return its sum.

// Constraints:
// 1 <= nums.length <= 10^5
// -10^4 <= nums[i] <= 10^4

//Code Structure:

/**
 * @param {number[]} nums
 * @return {number}
 */
var maxSubArray = function(nums) {
    let maxSum = nums[0]; // Initialize maxSum with the first element
    let currentSum = nums[0]; // Initialize currentSum with the first element

    for (let i = 1; i < nums.length; i++) {
        currentSum = Math.max(nums[i], currentSum + nums[i]); // Update currentSum
        maxSum = Math.max(maxSum, currentSum); // Update maxSum if currentSum is greater
    }

    return maxSum; // Return the maximum subarray sum
    
};
    