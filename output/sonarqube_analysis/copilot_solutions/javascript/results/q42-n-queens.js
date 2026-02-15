/** https://leetcode.com/problems/n-queens */
// Problem: N-Queens

//Problem Description:
//The n-queens puzzle is the problem of placing n queens on an n x n chessboard such that no two queens attack each other.
//Given an integer n, return all distinct solutions to the n-queens puzzle. You may return the answer in any order.
//Each solution contains a distinct board configuration of the n-queens' placement, where 'Q' and '.' both indicate a queen and an empty space, respectively.

// Constraints:
// 1 <= n <= 9

//Code Structure:
/**
 * @param {number} n
 * @return {string[][]}
 */
var solveNQueens = function(n) {
    const results = []; // Array to store the solutions
    const board = Array.from({ length: n }, () => '.'.repeat(n)); // Initialize the board with empty strings

    const isSafe = (row, col) => {
        for (let i = 0; i < row; i++) {
            if (board[i][col] === 'Q') return false; // Check column
            if (col - (row - i) >= 0 && board[i][col - (row - i)] === 'Q') return false; // Check left diagonal
            if (col + (row - i) < n && board[i][col + (row - i)] === 'Q') return false; // Check right diagonal
        }
        return true; // Safe to place a queen
    };

    const solve = (row) => {
        if (row === n) {
            results.push([...board]); // Add a valid solution to results
            return;
        }
        for (let col = 0; col < n; col++) {
            if (isSafe(row, col)) {
                board[row] = board[row].substring(0, col) + 'Q' + board[row].substring(col + 1); // Place a queen
                solve(row + 1); // Recur to place the next queen
                board[row] = board[row].substring(0, col) + '.' + board[row].substring(col + 1); // Backtrack
            }
        }
    };

    solve(0); // Start solving from the first row
    return results.map(solution => solution.map(row => row.split('')));
};
    