<?php
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

    /**
     * @param String[][] $grid
     * @return Integer
     */
    function numIslands($grid) {
        if (empty($grid)) {
            return 0;
        }

        $rows = count($grid);
        $cols = count($grid[0]);
        $islandCount = 0;

        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $cols; $j++) {
                if ($grid[$i][$j] === '1') {
                    $this->dfs($grid, $i, $j, $rows, $cols);
                    $islandCount++;
                }
            }
        }

        return $islandCount;  
    }

    private function dfs(&$grid, $i, $j, $rows, $cols) {
        if ($i < 0 || $i >= $rows || $j < 0 || $j >= $cols || $grid[$i][$j] === '0') {
            return;
        }

        // Mark the land as visited
        $grid[$i][$j] = '0';

        // Explore all four directions
        $this->dfs($grid, $i + 1, $j, $rows, $cols); // Down
        $this->dfs($grid, $i - 1, $j, $rows, $cols); // Up
        $this->dfs($grid, $i, $j + 1, $rows, $cols); // Right
        $this->dfs($grid, $i, $j - 1, $rows, $cols); // Left
    }
}
    