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
        if (empty($grid) || empty($grid[0])) {
            return 0;
        }
        
        $m = count($grid);
        $n = count($grid[0]);
        $islands = 0;
        
        for ($i = 0; $i < $m; $i++) {
            for ($j = 0; $j < $n; $j++) {
                if ($grid[$i][$j] == '1') {
                    $this->dfs($grid, $i, $j, $m, $n);
                    $islands++;
                }
            }
        }
        
        return $islands;
    }
    
    private function dfs(&$grid, $i, $j, $m, $n) {
        // Check bounds and if current cell is water or already visited
        if ($i < 0 || $i >= $m || $j < 0 || $j >= $n || $grid[$i][$j] != '1') {
            return;
        }
        
        // Mark current cell as visited
        $grid[$i][$j] = '0';
        
        // Visit all 4 directions
        $this->dfs($grid, $i + 1, $j, $m, $n); // down
        $this->dfs($grid, $i - 1, $j, $m, $n); // up
        $this->dfs($grid, $i, $j + 1, $m, $n); // right
        $this->dfs($grid, $i, $j - 1, $m, $n); // left
    }
}
    