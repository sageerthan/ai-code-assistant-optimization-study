# https://leetcode.com/problems/maximum-subarray/
# Problem: Maximum Subarray

#Problem Description:
#Given an integer array nums, find the subarray with the largest sum, and return its sum.

# Constraints:
# 1 <= nums.length <= 10^5
# -10^4 <= nums[i] <= 10^4

#Code Structure:

class Solution(object):
    def maxSubArray(self, nums):
        """
        :type nums: List[int]
        :rtype: int
        """
        # Kadane's algorithm
        max_sum = nums[0]
        current_sum = nums[0]
        
        for i in range(1, len(nums)):
            # Either extend the existing subarray or start a new one
            current_sum = max(nums[i], current_sum + nums[i])
            # Update the maximum sum found so far
            max_sum = max(max_sum, current_sum)
        
        return max_sum
    