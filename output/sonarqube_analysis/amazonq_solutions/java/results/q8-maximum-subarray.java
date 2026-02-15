/** https://leetcode.com/problems/maximum-subarray */
// Problem: Maximum Subarray

//Problem Description:
//Given an integer array nums, find the subarray with the largest sum, and return its sum.

// Constraints:
// 1 <= nums.length <= 10^5
// -10^4 <= nums[i] <= 10^4

//Code Structure:
class Solution {
    public int maxSubArray(int[] nums) {
        int maxSum = nums[0];
        int currentSum = nums[0];
        for (int i = 1; i < nums.length; i++) {
            currentSum = Math.max(nums[i], currentSum + nums[i]);
            maxSum = Math.max(maxSum, currentSum);
        }
        return maxSum;
    }
}
    