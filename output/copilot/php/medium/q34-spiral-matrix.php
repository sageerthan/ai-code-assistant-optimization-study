<?php
/** https://leetcode.com/problems/spiral-matrix */
// Problem: Spiral Matrix

//Problem Description:
//Given an m x n matrix, return all elements of the matrix in spiral order.

// Constraints:
// m == matrix.length
// n == matrix[i].length
// 1 <= m, n <= 10
// -100 <= matrix[i][j] <= 100

//Code Structure:

class Solution {

    /**
     * @param Integer[][] $matrix
     * @return Integer[]
     */
    function spiralOrder($matrix) {
        $result = [];
        if (empty($matrix)) {
            return $result;
        }

        $top = 0;
        $bottom = count($matrix) - 1;
        $left = 0;
        $right = count($matrix[0]) - 1;

        while ($top <= $bottom && $left <= $right) {
            // Traverse from left to right
            for ($i = $left; $i <= $right; $i++) {
                $result[] = $matrix[$top][$i];
            }
            $top++;

            // Traverse from top to bottom
            for ($i = $top; $i <= $bottom; $i++) {
                $result[] = $matrix[$i][$right];
            }
            $right--;

            if ($top <= $bottom) {
                // Traverse from right to left
                for ($i = $right; $i >= $left; $i--) {
                    $result[] = $matrix[$bottom][$i];
                }
                $bottom--;
            }

            if ($left <= $right) {
                // Traverse from bottom to top
                for ($i = $bottom; $i >= $top; $i--) {
                    $result[] = $matrix[$i][$left];
                }
                $left++;
            }
        }

        return $result;    
    }
}
    