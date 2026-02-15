# https://leetcode.com/problems/contains-duplicate/
# Problem: Contains Duplicate

#Problem Description:
#Given an integer array nums, return true if any value appears at least twice in the array, and return false if every element is distinct.

# Constraints:
# 1 <= nums.length <= 10^5
# -10^9 <= nums[i] <= 10^9

#Code Structure:
class Solution(object):
    def containsDuplicate(self, nums):
        """
        :type nums: List[int]
        :rtype: bool
        """
        return len(nums) != len(set(nums))
    