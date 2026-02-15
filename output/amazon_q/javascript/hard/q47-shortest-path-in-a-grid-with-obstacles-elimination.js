/** https://leetcode.com/problems/shortest-path-in-a-grid-with-obstacles-elimination */
// Problem: Shortest Path in a Grid with Obstacles Elimination

//Problem Description:
//You are given an m x n integer matrix grid where each cell is either 0 (empty) or 1 (obstacle). You can move up, down, left, or right from and to an empty cell in one step.
//Return the minimum number of steps to walk from the upper left corner (0, 0) to the lower right corner (m - 1, n - 1) given that you can eliminate at most k obstacles. If it is not possible to find such walk return -1.

// Constraints:
// m == grid.length
// n == grid[i].length
// 1 <= m, n <= 40
// 1 <= k <= m * n
// grid[i][j] is either 0 or 1.
// grid[0][0] == grid[m - 1][n - 1] == 0

//Code Structure:
/**
 * @param {number[][]} grid
 * @param {number} k
 * @return {number}
 */
var shortestPath = function(grid, k) {
    const m = grid.length;
    const n = grid[0].length;
    const directions = [[0, 1], [0, -1], [1, 0], [-1, 0]];
    const queue = [[0, 0, k, 0]]; // [row, col, remaining_k, steps]
    const visited = new Set();

    while (queue.length > 0) {
        const [row, col, remaining_k, steps] = queue.shift();

        if (row === m - 1 && col === n - 1) {
            return steps;
        }

        for (const [dx, dy] of directions) {
            const newRow = row + dx;
            const newCol = col + dy;

            if (newRow >= 0 && newRow < m && newCol >= 0 && newCol < n) {
                const newRemainingK = remaining_k - grid[newRow][newCol];

                if (newRemainingK >= 0) {
                    const key = `${newRow},${newCol},${newRemainingK}`;
                    if (!visited.has(key)) {
                        visited.add(key);
                        queue.push([newRow, newCol, newRemainingK, steps + 1]);
                    }
                }
            }
        }
    }

    return -1;
};
    