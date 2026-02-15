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
        $count = 0;
        for ($i = 0; $i < count($grid); $i++) {
            for ($j = 0; $j < count($grid[0]); $j++) {
                if ($grid[$i][$j] == '1') {
                    $this->dfs($grid, $i, $j);
                    $count++;
                }
            }
        }
        return $count;
    }
    
    private function dfs(&$grid, $i, $j) {
        if ($i < 0 || $i >= count($grid) || $j < 0 || $j >= count($grid[0]) || $grid[$i][$j] != '1') {
            return;
        }
        $grid[$i][$j] = '0';
        $this->dfs($grid, $i + 1, $j);
        $this->dfs($grid, $i - 1, $j);
        $this->dfs($grid, $i, $j + 1);
        $this->dfs($grid, $i, $j - 1);
    }
}
    