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
    let maxSoFar = nums[0];
    let maxEndingHere = nums[0];
    for (let i = 1; i < nums.length; i++) {
        maxEndingHere = Math.max(nums[i], maxEndingHere + nums[i]);
        maxSoFar = Math.max(maxSoFar, maxEndingHere);
    }
    return maxSoFar;
};
    