# https://leetcode.com/problems/burst-balloons/
# Problem: Burst Balloons

#Problem Description:
#You are given n balloons, indexed from 0 to n - 1. Each balloon is painted with a number on it represented by an array nums. You are asked to burst all the balloons.
#If you burst the ith balloon, you will get nums[i - 1] * nums[i] * nums[i + 1] coins. If i - 1 or i + 1 goes out of bounds of the array, then treat it as if there is a balloon with a 1 painted on it.
#Return the maximum coins you can collect by bursting the balloons wisely.

# Constraints:
# n == nums.length
# 1 <= n <= 300
# 0 <= nums[i] <= 100

#Code Structure:
class Solution(object):
    def maxCoins(self, nums):
        """
        :type nums: List[int]
        :rtype: int
        """
        n = len(nums)
        dp = [[0] * n for _ in range(n)]
        for length in range(1, n + 1):
            for left in range(n - length + 1):
                right = left + length - 1
                for i in range(left, right + 1):
                    dp[left][right] = max(dp[left][right], dp[left][i - 1] + dp[i + 1][right] + nums[left - 1] * nums[i] * nums[right + 1])
        return dp[0][n - 1]
    