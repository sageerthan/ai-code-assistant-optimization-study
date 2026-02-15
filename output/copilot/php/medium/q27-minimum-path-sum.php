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
        $rows = count($grid);
        $cols = count($grid[0]);

        // Create a DP array to store the minimum path sums
        $dp = array_fill(0, $rows, array_fill(0, $cols, 0));

        // Initialize the top-left corner
        $dp[0][0] = $grid[0][0];

        // Fill the first row
        for ($j = 1; $j < $cols; $j++) {
            $dp[0][$j] = $dp[0][$j - 1] + $grid[0][$j];
        }

        // Fill the first column
        for ($i = 1; $i < $rows; $i++) {
            $dp[$i][0] = $dp[$i - 1][0] + $grid[$i][0];
        }

        // Fill the rest of the DP array
        for ($i = 1; $i < $rows; $i++) {
            for ($j = 1; $j < $cols; $j++) {
                $dp[$i][$j] = min($dp[$i - 1][$j], $dp[$i][$j - 1]) + $grid[$i][$j];
            }
        }

        // The bottom-right corner contains the minimum path sum
        return $dp[$rows - 1][$cols - 1];  
    }
}
    