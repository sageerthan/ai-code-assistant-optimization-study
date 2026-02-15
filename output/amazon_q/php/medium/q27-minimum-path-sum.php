<?php
/** https://leetcode.com/problems/minimum-path-sum */
// Problem: Minimum Path Sum

//Problem Description:
//Given a m x n grid filled with non-negative numbers, find a path from top left to bottom right, which minimizes the sum of all numbers along its path.
//Note: You can only move either down or right at any point in time.

// Constraints:
// m == grid.length
// n == grid[i].length
// 1 <= m, n <= 200
// 0 <= grid[i][j] <= 200

//Code Structure:
class Solution {

    /**
     * @param Integer[][] $grid
     * @return Integer
     */
    function minPathSum($grid) {
        $m = count($grid);
        $n = count($grid[0]);
        for ($i = 1; $i < $m; $i++) {
            $grid[$i][0] += $grid[$i - 1][0];
        }
        for ($j = 1; $j < $n; $j++) {
            $grid[0][$j] += $grid[0][$j - 1];
        }
        for ($i = 1; $i < $m; $i++) {
            for ($j = 1; $j < $n; $j++) {
                $grid[$i][$j] += min($grid[$i - 1][$j], $grid[$i][$j - 1]);
            }
        }
        return $grid[$m - 1][$n - 1];
    }
}
    