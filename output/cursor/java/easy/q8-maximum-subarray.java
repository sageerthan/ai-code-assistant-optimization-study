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
        int maxSoFar = nums[0];
        int maxEndingHere = nums[0];
        
        for (int i = 1; i < nums.length; i++) {
            // Either extend the existing subarray or start a new one
            maxEndingHere = Math.max(nums[i], maxEndingHere + nums[i]);
            
            // Update the maximum sum found so far
            maxSoFar = Math.max(maxSoFar, maxEndingHere);
        }
        
        return maxSoFar;
    }
}
    