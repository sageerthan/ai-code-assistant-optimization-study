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
        if (empty($matrix) || empty($matrix[0])) {
            return [];
        }
        
        $m = count($matrix);
        $n = count($matrix[0]);
        $result = [];
        
        $top = 0;
        $bottom = $m - 1;
        $left = 0;
        $right = $n - 1;
        
        while ($top <= $bottom && $left <= $right) {
            // Traverse right
            for ($j = $left; $j <= $right; $j++) {
                $result[] = $matrix[$top][$j];
            }
            $top++;
            
            // Traverse down
            for ($i = $top; $i <= $bottom; $i++) {
                $result[] = $matrix[$i][$right];
            }
            $right--;
            
            // Traverse left (if there are rows left)
            if ($top <= $bottom) {
                for ($j = $right; $j >= $left; $j--) {
                    $result[] = $matrix[$bottom][$j];
                }
                $bottom--;
            }
            
            // Traverse up (if there are columns left)
            if ($left <= $right) {
                for ($i = $bottom; $i >= $top; $i--) {
                    $result[] = $matrix[$i][$left];
                }
                $left++;
            }
        }
        
        return $result;
    }
}
    