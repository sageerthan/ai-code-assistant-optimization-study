# https://leetcode.com/problems/trapping-rain-water/
# Problem: Trapping Rain Water

#Problem Description:
#Given n non-negative integers representing an elevation map where the width of each bar is 1, compute how much water it can trap after raining.

# Constraints:
# n == height.length
# 1 <= n <= 2 * 10^4
# 0 <= height[i] <= 10^5

#Code Structure:
class Solution(object):
    def trap(self, height):
        """
        :type height: List[int]
        :rtype: int
        """
        if not height:
            return 0
        
        left, right = 0, len(height) - 1
        left_max, right_max = 0, 0
        res = 0
        
        while left <= right:
            left_max = max(left_max, height[left])
            right_max = max(right_max, height[right])
            
            if left_max < right_max:
                res += left_max - height[left]
                left += 1
            else:
                res += right_max - height[right]
                right -= 1
        
        return res
    