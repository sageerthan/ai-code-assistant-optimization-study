# https://leetcode.com/problems/missing-number/
# Problem: Missing Number

#Problem Description:
#Given an array nums containing n distinct numbers in the range [0, n], return the only number in the range that is missing from the array.

# Constraints:
# n == nums.length
# 1 <= n <= 10^4
# 0 <= nums[i] <= n
# All the numbers of nums are unique.

#Code Structure:
class Solution(object):
    def missingNumber(self, nums):
        """
        :type nums: List[int]
        :rtype: int
        """
        n = len(nums)
        # Sum of numbers from 0 to n
        expected_sum = n * (n + 1) // 2
        # Sum of actual numbers in the array
        actual_sum = sum(nums)
        # The missing number is the difference
        return expected_sum - actual_sum
    