<?php
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

    /**
     * @param Integer[][] $grid
     * @param Integer $k
     * @return Integer
     */
    function shortestPath($grid, $k) {
        list($m, $n) = [count($grid), count($grid[0])];
        $dp = array_fill(0, $m, array_fill(0, $n, array_fill(0, $k + 1, INF)));
        $dp[0][0][0] = 0;
        $queue = [[0, 0, 0]];
        while ($queue) {
            list($x, $y, $z) = array_shift($queue);
            if ($x === $m - 1 && $y === $n - 1) return $dp[$x][$y][$z];
            for (list($nx, $ny) as [['x', 1], ['y', 0], ['x', -1], ['y', -1]]) {
                $i = $x + $nx;
                $j = $y + $ny;
                if ($i >= 0 && $i < $m && $j >= 0 && $j < $n && $dp[$i][$j][$z + $grid[$i][$j]] > $dp[$x][$y][$z] + 1) {
                    $dp[$i][$j][$z + $grid[$i][$j]] = $dp[$x][$y][$z] + 1;
                    $queue[] = [$i, $j, $z + $grid[$i][$j]];
                }
            }
        }
        return -1;
    }
}
    