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

/**
 * @param {number[][]} matrix
 * @return {number[]}
 */
var spiralOrder = function(matrix) {
    let m = matrix.length;
    if (m === 0) return [];
    let n = matrix[0].length;
    let res = [];
    let left = 0, right = n - 1, top = 0, bottom = m - 1;
    while (left <= right && top <= bottom) {
        for (let i = left; i <= right; i++) {
            res.push(matrix[top][i]);
        }
        top++;
        for (let i = top; i <= bottom; i++) {
            res.push(matrix[i][right]);
        }
        right--;
        if (top <= bottom) {
            for (let i = right; i >= left; i--) {
                res.push(matrix[bottom][i]);
            }
        }
        bottom--;
        if (left <= right) {
            for (let i = bottom; i >= top; i--) {
                res.push(matrix[i][left]);
            }
        }
        left++;
    }
    return res;
};
    