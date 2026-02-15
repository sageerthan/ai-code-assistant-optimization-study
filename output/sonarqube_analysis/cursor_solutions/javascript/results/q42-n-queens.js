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
    const result = [];
    const board = Array(n).fill().map(() => Array(n).fill('.'));
    
    solveNQueensHelper(board, 0, result);
    return result;
};

function solveNQueensHelper(board, row, result) {
    if (row === board.length) {
        // All queens placed successfully
        result.push(constructBoard(board));
        return;
    }
    
    for (let col = 0; col < board.length; col++) {
        if (isValid(board, row, col)) {
            board[row][col] = 'Q';
            solveNQueensHelper(board, row + 1, result);
            board[row][col] = '.'; // Backtrack
        }
    }
}

function isValid(board, row, col) {
    // Check column
    for (let i = 0; i < row; i++) {
        if (board[i][col] === 'Q') {
            return false;
        }
    }
    
    // Check diagonal (top-left to bottom-right)
    for (let i = row - 1, j = col - 1; i >= 0 && j >= 0; i--, j--) {
        if (board[i][j] === 'Q') {
            return false;
        }
    }
    
    // Check diagonal (top-right to bottom-left)
    for (let i = row - 1, j = col + 1; i >= 0 && j < board.length; i--, j++) {
        if (board[i][j] === 'Q') {
            return false;
        }
    }
    
    return true;
}

function constructBoard(board) {
    return board.map(row => row.join(''));
}
    