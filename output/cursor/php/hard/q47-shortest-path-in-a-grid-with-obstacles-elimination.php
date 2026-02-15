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
        
        // State: [row, col, obstacles_eliminated]
        $queue = [[0, 0, 0]];
        $visited = [];
        $visited[0][0][0] = true;
        
        $directions = [[0, 1], [1, 0], [0, -1], [-1, 0]];
        $steps = 0;
        
        while (!empty($queue)) {
            $size = count($queue);
            
            for ($i = 0; $i < $size; $i++) {
                [$row, $col, $obstacles] = array_shift($queue);
                
                // Check if we reached the destination
                if ($row === $m - 1 && $col === $n - 1) {
                    return $steps;
                }
                
                // Try all four directions
                foreach ($directions as [$dr, $dc]) {
                    $newRow = $row + $dr;
                    $newCol = $col + $dc;
                    
                    // Check bounds
                    if ($newRow < 0 || $newRow >= $m || $newCol < 0 || $newCol >= $n) {
                        continue;
                    }
                    
                    $newObstacles = $obstacles;
                    
                    // If the new cell is an obstacle
                    if ($grid[$newRow][$newCol] === 1) {
                        $newObstacles++;
                    }
                    
                    // Check if we can eliminate this obstacle
                    if ($newObstacles > $k) {
                        continue;
                    }
                    
                    // Check if we've visited this state before
                    if (isset($visited[$newRow][$newCol][$newObstacles])) {
                        continue;
                    }
                    
                    $visited[$newRow][$newCol][$newObstacles] = true;
                    $queue[] = [$newRow, $newCol, $newObstacles];
                }
            }
            
            $steps++;
        }
        
        return -1;
    }
}
    