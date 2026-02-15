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
        # Add boundary balloons with value 1
        balloons = [1] + nums + [1]
        n = len(balloons)
        
        # dp[i][j] = maximum coins from bursting balloons between i and j (exclusive)
        dp = [[0] * n for _ in range(n)]
        
        # Fill dp table for different lengths
        for length in range(2, n):  # length of subarray
            for left in range(n - length):
                right = left + length
                
                # Try each balloon between left and right as the last one to burst
                for k in range(left + 1, right):
                    # Coins from bursting balloon k last
                    coins = balloons[left] * balloons[k] * balloons[right]
                    # Add coins from left and right subproblems
                    total = coins + dp[left][k] + dp[k][right]
                    dp[left][right] = max(dp[left][right], total)
        
        return dp[0][n - 1]
    