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
        $result = [];
        $cols = [];
        $diag1 = [];
        $diag2 = [];
        $this->backtrack($result, [], 0, $n, $cols, $diag1, $diag2);
        return $result;
    }
    
    private function backtrack(&$result, $board, $row, $n, &$cols, &$diag1, &$diag2) {
        if ($row == $n) {
            $result[] = $board;
            return;
        }
        
        for ($col = 0; $col < $n; $col++) {
            if (isset($cols[$col]) || isset($diag1[$row - $col]) || isset($diag2[$row + $col])) {
                continue;
            }
            
            $cols[$col] = true;
            $diag1[$row - $col] = true;
            $diag2[$row + $col] = true;
            
            $rowStr = str_repeat('.', $n);
            $rowStr[$col] = 'Q';
            $board[] = $rowStr;
            
            $this->backtrack($result, $board, $row + 1, $n, $cols, $diag1, $diag2);
            
            array_pop($board);
            unset($cols[$col]);
            unset($diag1[$row - $col]);
            unset($diag2[$row + $col]);
        }
    }
}
    