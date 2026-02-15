# https://leetcode.com/problems/shortest-path-in-a-grid-with-obstacles-elimination/
# Problem: Shortest Path in a Grid with Obstacles Elimination

#Problem Description:
#You are given an m x n integer matrix grid where each cell is either 0 (empty) or 1 (obstacle). You can move up, down, left, or right from and to an empty cell in one step.
#Return the minimum number of steps to walk from the upper left corner (0, 0) to the lower right corner (m - 1, n - 1) given that you can eliminate at most k obstacles. If it is not possible to find such walk return -1.

# Constraints:
# m == grid.length
# n == grid[i].length
# 1 <= m, n <= 40
# 1 <= k <= m * n
# grid[i][j] is either 0 or 1.
# grid[0][0] == grid[m - 1][n - 1] == 0

#Code Structure:
class Solution(object):
    def shortestPath(self, grid, k):
        """
        :type grid: List[List[int]]
        :type k: int
        :rtype: int
        """
        m, n = len(grid), len(grid[0])
        dp = [[[float('inf')] * (k + 1) for _ in range(n)] for _ in range(m)]
        dp[0][0][0] = 0
        directions = [(1, 0), (-1, 0), (0, 1), (0, -1)]
        for i in range(m):
            for j in range(n):
                for r in range(min(k + 1, i + j + 1)):
                    for dx, dy in directions:
                        nx, ny = i + dx, j + dy
                        if 0 <= nx < m and 0 <= ny < n:
                            if grid[nx][ny] == 1:
                                dp[nx][ny][r + 1] = min(dp[nx][ny][r + 1], dp[i][j][r] + 1)
                            else:
                                dp[nx][ny][r] = min(dp[nx][ny][r], dp[i][j][r] + 1)
        return dp[m - 1][n - 1][k] if dp[m - 1][n - 1][k] != float('inf') else -1
    