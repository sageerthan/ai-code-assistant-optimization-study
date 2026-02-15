<?php
/** https://leetcode.com/problems/n-queens */
// Problem: N-Queens

//Problem Description:
//The n-queens puzzle is the problem of placing n queens on an n x n chessboard such that no two queens attack each other.
//Given an integer n, return all distinct solutions to the n-queens puzzle. You may return the answer in any order.
//Each solution contains a distinct board configuration of the n-queens' placement, where 'Q' and '.' both indicate a queen and an empty space, respectively.

// Constraints:
// 1 <= n <= 9

//Code Structure:
class Solution {

    /**
     * @param Integer $n
     * @return String[][]
     */
    function solveNQueens($n) {
        $this->result = [];
        $this->solve($n, 0, [], [], []);
        return $this->result;
        
    }
    
    private function solve($n, $row, $cols, $posDiag, $negDiag) {
        if ($row === $n) {
            $this->result[] = $this->construct($cols);
            return;
        }
        for ($col = 0; $col < $n; $col++) {
            if (in_array($col, $cols) || in_array($row + $col, $posDiag) || in_array($row - $col, $negDiag)) {
                continue;
            }
            $cols[] = $col;
            $posDiag[] = $row + $col;
            $negDiag[] = $row - $col;
            $this->solve($n, $row + 1, $cols, $posDiag, $negDiag);
            array_pop($cols);
            array_pop($posDiag);
            array_pop($negDiag);
        }
    }
    
    private function construct($cols) {
        $n = count($cols);
        $result = [];
        for ($i = 0; $i < $n; $i++) {
            $str = '';
            for ($j = 0; $j < $n; $j++) {
                if ($j === $cols[$i]) {
                    $str .= 'Q';
                } else {
                    $str .= '.';
                }
            }
            $result[] = $str;
        }
        return $result;
    }
}   