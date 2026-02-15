/** https://leetcode.com/problems/number-of-islands */
// Problem: Number of Islands 

//Problem Description:
//Given an m x n 2D binary grid grid which represents a map of '1's (land) and '0's (water), return the number of islands.
//An island is surrounded by water and is formed by connecting adjacent lands horizontally or vertically. You may assume all four edges of the grid are all surrounded by water.

// Constraints:
// m == grid.length
// n == grid[i].length
// 1 <= m, n <= 300
// grid[i][j] is '0' or '1'.

//Code Structure:
class Solution {
    public int numIslands(char[][] grid) {
        if (grid == null || grid.length == 0 || grid[0].length == 0) {
            return 0;
        }

        int rows = grid.length;
        int cols = grid[0].length;
        int islandCount = 0;

        for (int i = 0; i < rows; i++) {
            for (int j = 0; j < cols; j++) {
                if (grid[i][j] == '1') {
                    islandCount++;
                    markIsland(grid, i, j);
                }
            }
        }

        return islandCount;
    }

    private void markIsland(char[][] grid, int i, int j) {
        if (i < 0 || i >= grid.length || j < 0 || j >= grid[0].length || grid[i][j] == '0') {
            return;
        }

        // Mark the current cell as visited
        grid[i][j] = '0';

        // Recursively mark all adjacent land cells
        markIsland(grid, i - 1, j); // Up
        markIsland(grid, i + 1, j); // Down
        markIsland(grid, i, j - 1); // Left
        markIsland(grid, i, j + 1); // Right
    }
}
    