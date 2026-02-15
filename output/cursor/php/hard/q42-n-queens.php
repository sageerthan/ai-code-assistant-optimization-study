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
        $board = array_fill(0, $n, str_repeat('.', $n));
        $this->backtrack($board, 0, $result);
        return $result;
    }
    
    private function backtrack(&$board, $row, &$result) {
        $n = count($board);
        
        if ($row === $n) {
            $result[] = $board;
            return;
        }
        
        for ($col = 0; $col < $n; $col++) {
            if ($this->isValid($board, $row, $col)) {
                $board[$row][$col] = 'Q';
                $this->backtrack($board, $row + 1, $result);
                $board[$row][$col] = '.';
            }
        }
    }
    
    private function isValid($board, $row, $col) {
        $n = count($board);
        
        // Check column
        for ($i = 0; $i < $row; $i++) {
            if ($board[$i][$col] === 'Q') {
                return false;
            }
        }
        
        // Check diagonal (top-left to bottom-right)
        for ($i = $row - 1, $j = $col - 1; $i >= 0 && $j >= 0; $i--, $j--) {
            if ($board[$i][$j] === 'Q') {
                return false;
            }
        }
        
        // Check diagonal (top-right to bottom-left)
        for ($i = $row - 1, $j = $col + 1; $i >= 0 && $j < $n; $i--, $j++) {
            if ($board[$i][$j] === 'Q') {
                return false;
            }
        }
        
        return true;
    }
}
    