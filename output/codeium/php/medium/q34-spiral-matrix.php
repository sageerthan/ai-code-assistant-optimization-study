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
        $rows = count($matrix);
        $columns = count($matrix[0]);
        $rowStart = $columnStart = 0;
        $rowEnd = $rows - 1;
        $columnEnd = $columns - 1;

        while ($rowStart <= $rowEnd && $columnStart <= $columnEnd) {
            for ($i = $columnStart; $i <= $columnEnd; $i++) {
                $result[] = $matrix[$rowStart][$i];
            }
            $rowStart++;
            for ($i = $rowStart; $i <= $rowEnd; $i++) {
                $result[] = $matrix[$i][$columnEnd];
            }
            $columnEnd--;
            if ($rowStart <= $rowEnd) {
                for ($i = $columnEnd; $i >= $columnStart; $i--) {
                    $result[] = $matrix[$rowEnd][$i];
                }
            }
            $rowEnd--;
            if ($columnStart <= $columnEnd) {
                for ($i = $rowEnd; $i >= $rowStart; $i--) {
                    $result[] = $matrix[$i][$columnStart];
                }
            }
            $columnStart++;
        }
        return $result;
    }
}
    