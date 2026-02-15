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
     * Solves the n-queens puzzle and returns all distinct solutions.
     * Uses backtracking to generate valid board configurations.
     * @param Integer $n
     * @return String[][]
     */
    function solveNQueens($n) {
        $res = [];
        $board = array_fill(0, $n, str_repeat('.', $n));
        $cols = [];
        $diag1 = [];
        $diag2 = [];

        // Helper function for backtracking
        function backtrack($row, $n, &$board, &$cols, &$diag1, &$diag2, &$res) {
            if ($row == $n) {
                $res[] = $board;
                return;
            }
            for ($col = 0; $col < $n; $col++) {
                if (!empty($cols[$col]) || !empty($diag1[$row - $col]) || !empty($diag2[$row + $col])) {
                    continue;
                }
                // Place queen
                $board[$row][$col] = 'Q';
                $cols[$col] = true;
                $diag1[$row - $col] = true;
                $diag2[$row + $col] = true;
                backtrack($row + 1, $n, $board, $cols, $diag1, $diag2, $res);
                // Remove queen (backtrack)
                $board[$row][$col] = '.';
                unset($cols[$col]);
                unset($diag1[$row - $col]);
                unset($diag2[$row + $col]);
            }
        }

        backtrack(0, $n, $board, $cols, $diag1, $diag2, $res);
        return $res;
    }
}
