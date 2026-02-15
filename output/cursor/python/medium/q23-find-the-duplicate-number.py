# https://leetcode.com/problems/find-the-duplicate-number/
# Problem: Find the Duplicate Number

#Problem Description:
#Given an array of integers nums containing n + 1 integers where each integer is in the range [1, n] inclusive.
#There is only one repeated number in nums, return this repeated number.
#You must solve the problem without modifying the array nums and using only constant extra space.

# Constraints:
# 1 <= n <= 10^5
# nums.length == n + 1
# 1 <= nums[i] <= n
# All the integers in nums appear only once except for precisely one integer which appears two or more times.

#Code Structure:

class Solution(object):
    def findDuplicate(self, nums):
        """
        :type nums: List[int]
        :rtype: int
        """
        # Floyd's cycle detection algorithm (tortoise and hare)
        slow = nums[0]
        fast = nums[0]
        
        # Phase 1: Find the intersection point in the cycle
        while True:
            slow = nums[slow]
            fast = nums[nums[fast]]
            if slow == fast:
                break
        
        # Phase 2: Find the entrance to the cycle
        slow = nums[0]
        while slow != fast:
            slow = nums[slow]
            fast = nums[fast]
        
        return slow
    