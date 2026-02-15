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

class Solution {
    public int shortestPath(int[][] grid, int k) {
        int m = grid.length, n = grid[0].length;
        if (m == 0 || n == 0) return -1;

        // Directions for moving in the grid
        int[][] directions = {{1, 0}, {-1, 0}, {0, 1}, {0, -1}};
        
        // Queue for BFS: stores (x, y, steps, obstacles eliminated)
        Queue<int[]> queue = new LinkedList<>();
        queue.offer(new int[]{0, 0, 0, 0}); // Start from (0, 0) with 0 steps and 0 obstacles eliminated
        
        // Visited array to track the minimum obstacles eliminated at each cell
        boolean[][][] visited = new boolean[m][n][k + 1];
        visited[0][0][0] = true;

        while (!queue.isEmpty()) {
            int[] current = queue.poll();
            int x = current[0], y = current[1], steps = current[2], obstacles = current[3];

            // If we reach the bottom-right corner
            if (x == m - 1 && y == n - 1) {
                return steps;
            }

            // Explore all possible directions
            for (int[] dir : directions) {
                int newX = x + dir[0], newY = y + dir[1];

                // Check bounds
                if (newX >= 0 && newX < m && newY >= 0 && newY < n) {
                    int newObstacles = obstacles + grid[newX][newY];

                    // If we can eliminate this obstacle and haven't visited this state yet
                    if (newObstacles <= k && !visited[newX][newY][newObstacles]) {
                        visited[newX][newY][newObstacles] = true;
                        queue.offer(new int[]{newX, newY, steps + 1, newObstacles});
                    }
                }
            }
        }
        return -1; // If we cannot reach the bottom-right corner 
    }
}
    