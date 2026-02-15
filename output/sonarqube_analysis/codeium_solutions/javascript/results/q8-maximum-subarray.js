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
    let maxSoFar = 0;
    let maxEndingHere = 0;
    for (let i = 0; i < nums.length; i++) {
        maxEndingHere = maxEndingHere + nums[i];
        if (maxEndingHere < 0) {
            maxEndingHere = 0;
        }
        if (maxEndingHere > maxSoFar) {
            maxSoFar = maxEndingHere;
        }
    }
    return maxSoFar;
};
    