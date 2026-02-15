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
        
        # BFS with state: (row, col, obstacles_eliminated)
        queue = [(0, 0, 0, 0)]  # (row, col, obstacles_eliminated, steps)
        visited = set()
        visited.add((0, 0, 0))
        
        directions = [(0, 1), (1, 0), (0, -1), (-1, 0)]
        
        while queue:
            row, col, obstacles, steps = queue.pop(0)
            
            # Check if we reached the destination
            if row == m - 1 and col == n - 1:
                return steps
            
            # Try all four directions
            for dr, dc in directions:
                new_row, new_col = row + dr, col + dc
                
                # Check bounds
                if 0 <= new_row < m and 0 <= new_col < n:
                    new_obstacles = obstacles
                    
                    # If the new cell is an obstacle
                    if grid[new_row][new_col] == 1:
                        new_obstacles += 1
                    
                    # Check if we can eliminate this obstacle
                    if new_obstacles <= k:
                        state = (new_row, new_col, new_obstacles)
                        if state not in visited:
                            visited.add(state)
                            queue.append((new_row, new_col, new_obstacles, steps + 1))
        
        return -1
    