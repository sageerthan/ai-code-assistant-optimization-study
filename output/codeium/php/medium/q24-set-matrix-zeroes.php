<?php
/** https://leetcode.com/problems/set-matrix-zeroes */
// Problem: Set Matrix Zeroes

//Problem Description:
//Given an m x n integer matrix matrix, if an element is 0, set its entire row and column to 0's.

// Constraints:
// m == matrix.length
// n == matrix[0].length
// 1 <= m, n <= 200
// -2^31 <= matrix[i][j] <= 2^31 - 1

//Code Structure:
class Solution {

    /**
     * @param Integer[][] $matrix
     * @return NULL
     */
    function setZeroes(&$matrix) {
        $m = count($matrix);
        $n = count($matrix[0]);
        $firstRowHasZero = false;
        $firstColHasZero = false;
        
        // mark the first row and column for the zeros
        for ($i = 0; $i < $m; $i++) {
            if ($matrix[$i][0] == 0) {
                $firstColHasZero = true;
            }
        }
        for ($j = 0; $j < $n; $j++) {
            if ($matrix[0][$j] == 0) {
                $firstRowHasZero = true;
            }
        }
        
        // mark the cells
        for ($i = 1; $i < $m; $i++) {
            for ($j = 1; $j < $n; $j++) {
                if ($matrix[$i][$j] == 0) {
                    $matrix[$i][0] = 0;
                    $matrix[0][$j] = 0;
                }
            }
        }
        
        // set the cells to zero
        for ($i = 1; $i < $m; $i++) {
            for ($j = 1; $j < $n; $j++) {
                if ($matrix[$i][0] == 0 || $matrix[0][$j] == 0) {
                    $matrix[$i][$j] = 0;
                }
            }
        }
        
        // set the first row and column to zeros if needed
        if ($firstRowHasZero) {
            for ($j = 0; $j < $n; $j++) {
                $matrix[0][$j] = 0;
            }
        }
        if ($firstColHasZero) {
            for ($i = 0; $i < $m; $i++) {
                $matrix[$i][0] = 0;
            }
        }
    }
}
    