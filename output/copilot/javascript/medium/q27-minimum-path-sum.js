/** https://leetcode.com/problems/minimum-path-sum */
// Problem: Minimum Path Sum

//Problem Description:
//Given a m x n grid filled with non-negative numbers, find a path from top left to bottom right, which minimizes the sum of all numbers along its path.
//Note: You can only move either down or right at any point in time.

// Constraints:
// m == grid.length
// n == grid[i].length
// 1 <= m, n <= 200
// 0 <= grid[i][j] <= 200

//Code Structure:
/**
 * @param {number[][]} grid
 * @return {number}
 */
var minPathSum = function(grid) {
    const m = grid.length; // Number of rows
    const n = grid[0].length; // Number of columns

    // Create a 2D array to store the minimum path sums
    const dp = Array.from({ length: m }, () => Array(n).fill(0));

    // Initialize the top-left corner
    dp[0][0] = grid[0][0];

    // Fill the first row
    for (let j = 1; j < n; j++) {
        dp[0][j] = dp[0][j - 1] + grid[0][j];
    }

    // Fill the first column
    for (let i = 1; i < m; i++) {
        dp[i][0] = dp[i - 1][0] + grid[i][0];
    }

    // Fill the rest of the dp array
    for (let i = 1; i < m; i++) {
        for (let j = 1; j < n; j++) {
            dp[i][j] = Math.min(dp[i - 1][j], dp[i][j - 1]) + grid[i][j];
        }
    }

    // The bottom-right corner contains the minimum path sum
    return dp[m - 1][n - 1];    
};
    