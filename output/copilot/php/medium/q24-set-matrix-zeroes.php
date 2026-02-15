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
        $rows = count($matrix);
        $cols = count($matrix[0]);
        $zeroRows = array_fill(0, $rows, false);
        $zeroCols = array_fill(0, $cols, false);

        // First pass: identify rows and columns that need to be zeroed
        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $cols; $j++) {
                if ($matrix[$i][$j] === 0) {
                    $zeroRows[$i] = true;
                    $zeroCols[$j] = true;
                }
            }
        }

        // Second pass: set the identified rows and columns to zero
        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $cols; $j++) {
                if ($zeroRows[$i] || $zeroCols[$j]) {
                    $matrix[$i][$j] = 0;
                }
            }
        }     
    }
}
    