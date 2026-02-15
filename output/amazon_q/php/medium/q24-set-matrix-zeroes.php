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
        $rows = [];
        $cols = [];
        for ($i = 0; $i < $m; $i++) {
            for ($j = 0; $j < $n; $j++) {
                if ($matrix[$i][$j] == 0) {
                    $rows[$i] = true;
                    $cols[$j] = true;
                }
            }
        }
        for ($i = 0; $i < $m; $i++) {
            for ($j = 0; $j < $n; $j++) {
                if (isset($rows[$i]) || isset($cols[$j])) {
                    $matrix[$i][$j] = 0;
                }
            }
        }
    }
}
    