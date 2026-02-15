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

// First generated code

class Solution {
    public int shortestPath(int[][] grid, int k) {
        int m = grid.length, n = grid[0].length;
        int[][][] dp = new int[m][n][k + 1];
        for (int i = 0; i < m; i++) {
            for (int j = 0; j < n; j++) {
                Arrays.fill(dp[i][j], -1);
            }
        }
        dp[0][0][0] = 0;
        Queue<int[]> queue = new LinkedList<>();
        queue.offer(new int[] {0, 0, 0});
        int[][] dirs = {{1, 0}, {-1, 0}, {0, 1}, {0, -1}};
        while (!queue.isEmpty()) {
            int x = queue.peek()[0], y = queue.peek()[1], z = queue.peek()[2];
            queue.poll();
            for (int[] dir : dirs) {
                int nx = x + dir[0], ny = y + dir[1];
                if (nx >= 0 && nx < m && ny >= 0 && ny < n && (grid[nx][ny] == 0 || z > 0)) {
                    int nz = grid[nx][ny] == 1 ? z - 1 : z;
                    if (dp[nx][ny][nz] == -1) {
                        dp[nx][ny][nz] = dp[x][y][z] + 1;
                        queue.offer(new int[] {nx, ny, nz});
                    }
                }
            }
        }
        for (int i = k; i >= 0; i--) {
            if (dp[m - 1][n - 1][i] != -1) return dp[m - 1][n - 1][i];
        }
        return -1;
    }
}

// Debugged Code

class Solution {
    int[][] directions = {{-1, 0}, {1, 0}, {0, -1}, {0, 1}};
    
    public int removeObstacles(int[][] grid, int k) {
        int rows = grid.length;
        int cols = grid[0].length;
        int count = 0;
        
        // Step 1: Count the number of islands before removing obstacles
        boolean[][] visited = new boolean[rows][cols];
        for (int i = 0; i < rows; i++) {
            for (int j = 0; j < cols; j++) {
                if (grid[i][j] == 1 && !visited[i][j]) {
                    count++;
                    dfs(grid, visited, i, j);
                }
            }
        }
        
        // Step 2: Remove the obstacles and count the number of islands again
        int remaining = count;
        for (int i = 0; i < rows; i++) {
            for (int j = 0; j < cols; j++) {
                if (grid[i][j] == 1) {
                    grid[i][j] = 0;
                    if (--k == 0) {
                        // Create a new visited array for the second DFS
                        boolean[][] visited2 = new boolean[rows][cols];
                        if (dfs(grid, visited2, i, j)) {
                            remaining--;
                        }
                    }
                }
            }
        }
        
        return remaining;
    }
    
    private void dfs(int[][] grid, boolean[][] visited, int i, int j) {
        rows = grid.length;
        cols = grid[0].length;
        visited[i][j] = true;
        
        for (int[] direction : directions) {
            int x = i + direction[0];
            int y = j + direction[1];
            if (x >= 0 && x < rows && y >= 0 && y < cols && !visited[x][y] && grid[x][y] == 1) {
                dfs(grid, visited, x, y);
            }
        }
    }
    
    private boolean dfs(int[][] grid, boolean[][] visited, int i, int j) {
        rows = grid.length;
        cols = grid[0].length;
        visited[i][j] = true;
        
        for (int[] direction : directions) {
            int x = i + direction[0];
            int y = j + direction[1];
            if (x >= 0 && x < rows && y >= 0 && y < cols && !visited[x][y] && grid[x][y] == 1) {
                dfs(grid, visited, x, y);
            }
        }
        
        return !visited[0][0] || !visited[rows-1][cols-1];
    }
}
    