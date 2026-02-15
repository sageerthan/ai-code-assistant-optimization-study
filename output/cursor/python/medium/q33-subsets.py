# https://leetcode.com/problems/subsets/
# Problem: Subsets

#Problem Description:
#Given an integer array nums of unique elements, return all possible subsets (the power set).
#The solution set must not contain duplicate subsets. Return the solution in any order.

# Constraints:
# 1 <= nums.length <= 10
# -10 <= nums[i] <= 10
# All the numbers of nums are unique.

#Code Structure:

class Solution(object):
    def subsets(self, nums):
        """
        :type nums: List[int]
        :rtype: List[List[int]]
        """
        result = []
        self.backtrack(nums, 0, [], result)
        return result
    
    def backtrack(self, nums, start, current, result):
        result.append(current[:])
        
        for i in range(start, len(nums)):
            current.append(nums[i])
            self.backtrack(nums, i + 1, current, result)
            current.pop()
    