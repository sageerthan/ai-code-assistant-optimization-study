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
        $m = count($grid);
        $n = count($grid[0]);
        $directions = [[0, 1], [1, 0], [0, -1], [-1, 0]];
        $queue = new SplQueue();
        $queue->enqueue([0, 0, 0, $k]); // x, y, steps, remaining_k
        $visited = [];
        while (!$queue->isEmpty()) {
            [$x, $y, $steps, $remaining_k] = $queue->dequeue();
            if ($x === $m - 1 && $y === $n - 1) return $steps;
            foreach ($directions as [$dx, $dy]) {
                $nx = $x + $dx;
                $ny = $y + $dy;
                if ($nx < 0 || $ny < 0 || $nx >= $m || $ny >= $n) continue;
                if ($grid[$nx][$ny] === 1 && $remaining_k > 0) {
                    $remaining_k--;
                } elseif ($grid[$nx][$ny] === 1) {
                    continue;
                }
                $state = [$nx, $ny, $remaining_k];
                if (!isset($visited[serialize($state)])) {
                    $visited[serialize($state)] = true;
                    $queue->enqueue([$nx, $ny, $steps + 1, $remaining_k]);
                }
            }
        }
        return -1;
    }
}
    