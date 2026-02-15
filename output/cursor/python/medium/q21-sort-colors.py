# https://leetcode.com/problems/sort-colors/
# Problem: Sort Colors

#Problem Description:
#Given an array nums with n objects colored red, white, or blue, sort them in-place so that objects of the same color are adjacent, with the colors in the order red, white, and blue.
#We will use the integers 0, 1, and 2 to represent the color red, white, and blue, respectively.
#You must solve this problem without using the library's sort function.

# Constraints:
# n == nums.length
# 1 <= n <= 300
# nums[i] is either 0, 1, or 2.

#Code Structure:

class Solution(object):
    def sortColors(self, nums):
        """
        :type nums: List[int]
        :rtype: None Do not return anything, modify nums in-place instead.
        """
        left = 0
        right = len(nums) - 1
        current = 0
        
        while current <= right:
            if nums[current] == 0:
                # Swap with left pointer
                nums[left], nums[current] = nums[current], nums[left]
                left += 1
                current += 1
            elif nums[current] == 2:
                # Swap with right pointer
                nums[right], nums[current] = nums[current], nums[right]
                right -= 1
                # Don't increment current here as we need to check the swapped element
            else:
                # nums[current] == 1, just move forward
                current += 1
    