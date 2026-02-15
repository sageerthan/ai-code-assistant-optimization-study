# https://leetcode.com/problems/trapping-rain-water/
# Problem: Trapping Rain Water

#Problem Description:
#Given n non-negative integers representing an elevation map where the width of each bar is 1, compute how much water it can trap after raining.

# Constraints:
# n == height.length
# 1 <= n <= 2 * 104
# 0 <= height[i] <= 105

#Code Structure:
class Solution(object):
    def trap(self, height):
        """
        :type height: List[int]
        :rtype: int
        """
        if not height:
            return 0
        
        n = len(height)
        left_max = [0] * n
        right_max = [0] * n
        
        left_max[0] = height[0]
        for i in range(1, n):
            left_max[i] = max(left_max[i - 1], height[i])
        
        right_max[n - 1] = height[n - 1]
        for i in range(n - 2, -1, -1):
            right_max[i] = max(right_max[i + 1], height[i])
        
        water_trapped = 0
        for i in range(n):
            water_trapped += min(left_max[i], right_max[i]) - height[i]
        
        return water_trapped                               
    