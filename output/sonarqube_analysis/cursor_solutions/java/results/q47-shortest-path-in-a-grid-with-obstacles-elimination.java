/** https://leetcode.com/problems/shortest-path-in-a-grid-with-obstacles-elimination */
// Problem: Shortest Path in a Grid with Obstacles Elimination

//Problem Description:
//You are given an m x n integer matrix grid where each cell is either 0 (empty) or 1 (obstacle). You can move up, down, left, or right from and to an empty cell in one step.
//Return the minimum number of steps to walk from the upper left corner (0, 0) to the lower right corner (m - 1, n - 1) given that you can eliminate at most k obstacles. If it is not possible to find such walk return -1.

// Constraints:
// m == grid.length
// n == grid[i].length
// 1 <= m, n <= 40
// 1 <= k <= m * n
// grid[i][j] is either 0 or 1.
// grid[0][0] == grid[m - 1][n - 1] == 0

//Code Structure:

import java.util.*;

class Solution {
    public int shortestPath(int[][] grid, int k) {
        int m = grid.length;
        int n = grid[0].length;
        
        // State: [row, col, obstacles_eliminated]
        Queue<int[]> queue = new LinkedList<>();
        boolean[][][] visited = new boolean[m][n][k + 1];
        
        queue.offer(new int[]{0, 0, 0});
        visited[0][0][0] = true;
        
        int steps = 0;
        int[][] directions = {{0, 1}, {1, 0}, {0, -1}, {-1, 0}};
        
        while (!queue.isEmpty()) {
            int size = queue.size();
            
            for (int i = 0; i < size; i++) {
                int[] current = queue.poll();
                int row = current[0];
                int col = current[1];
                int obstacles = current[2];
                
                // Check if reached destination
                if (row == m - 1 && col == n - 1) {
                    return steps;
                }
                
                // Explore all four directions
                for (int[] dir : directions) {
                    int newRow = row + dir[0];
                    int newCol = col + dir[1];
                    
                    // Check bounds
                    if (newRow < 0 || newRow >= m || newCol < 0 || newCol >= n) {
                        continue;
                    }
                    
                    int newObstacles = obstacles;
                    
                    // If new cell is obstacle, increment obstacle count
                    if (grid[newRow][newCol] == 1) {
                        newObstacles++;
                    }
                    
                    // Check if we can eliminate this obstacle and haven't visited this state
                    if (newObstacles <= k && !visited[newRow][newCol][newObstacles]) {
                        visited[newRow][newCol][newObstacles] = true;
                        queue.offer(new int[]{newRow, newCol, newObstacles});
                    }
                }
            }
            
            steps++;
        }
        
        return -1; // No path found
    }
}
    