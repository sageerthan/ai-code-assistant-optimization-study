# https://leetcode.com/problems/minimum-path-sum/
# Problem: Minimum Path Sum

#Problem Description:
#Given a m x n grid filled with non-negative numbers, find a path from top left to bottom right, which minimizes the sum of all numbers along its path.
#Note: You can only move either down or right at any point in time.

# Constraints:
# m == grid.length
# n == grid[i].length
# 1 <= m, n <= 200
# 0 <= grid[i][j] <= 200

#Code Structure:

class Solution(object):
    def minPathSum(self, grid):
        """
        :type grid: List[List[int]]
        :rtype: int
        """
        m = len(grid)
        n = len(grid[0])
        
        # Initialize first row
        for j in range(1, n):
            grid[0][j] += grid[0][j - 1]
        
        # Initialize first column
        for i in range(1, m):
            grid[i][0] += grid[i - 1][0]
        
        # Fill the rest of the grid
        for i in range(1, m):
            for j in range(1, n):
                grid[i][j] += min(grid[i - 1][j], grid[i][j - 1])
        
        return grid[m - 1][n - 1]
    