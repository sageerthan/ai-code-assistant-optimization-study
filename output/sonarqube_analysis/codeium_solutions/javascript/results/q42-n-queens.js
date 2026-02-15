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
    const cols = new Set();
    const posDiag = new Set();
    const negDiag = new Set();
    
    function solve(row, solution) {
        if (row === n) {
            result.push(solution);
            return;
        }
        for (let col = 0; col < n; col++) {
            if (cols.has(col) || posDiag.has(row + col) || negDiag.has(row - col)) {
                continue;
            }
            cols.add(col);
            posDiag.add(row + col);
            negDiag.add(row - col);
            solve(row + 1, solution.concat([`.${Array(n).fill('.').map((_, i) => i === col ? 'Q' : '.').join('')}`]));
            cols.delete(col);
            posDiag.delete(row + col);
            negDiag.delete(row - col);
        }
    }
    solve(0, []);
    return result;
};
    