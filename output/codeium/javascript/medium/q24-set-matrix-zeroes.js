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
/**
 * @param {number[][]} matrix
 * @return {void} Do not return anything, modify matrix in-place instead.
 */
var setZeroes = function(matrix) {
    let rows = matrix.length;
    let cols = matrix[0].length;
    let rowHasZero = new Array(rows).fill(false);
    let colHasZero = new Array(cols).fill(false);
    
    for (let i = 0; i < rows; i++) {
        for (let j = 0; j < cols; j++) {
            if (matrix[i][j] === 0) {
                rowHasZero[i] = true;
                colHasZero[j] = true;
            }
        }
    }
    
    for (let i = 0; i < rows; i++) {
        for (let j = 0; j < cols; j++) {
            if (rowHasZero[i] || colHasZero[j]) {
                matrix[i][j] = 0;
            }
        }
    }
};
    