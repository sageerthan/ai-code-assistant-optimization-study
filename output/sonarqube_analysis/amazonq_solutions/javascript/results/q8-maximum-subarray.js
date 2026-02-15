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
    // Initialize the maximum sum to the first element of the array
    let maxSum = nums[0];

    // Initialize the current sum to 0
    let currentSum = 0;

    // Iterate through the array
    for (let i = 0; i < nums.length; i++) {
        // Update the current sum by adding the current element
        currentSum += nums[i];

        // Update the maximum sum if the current sum is greater
        maxSum = Math.max(maxSum, currentSum);

        // If the current sum is negative, reset it to 0
        if (currentSum < 0) {
            currentSum = 0;
        }
    }

    // Return the maximum sum
    return maxSum;
};
    