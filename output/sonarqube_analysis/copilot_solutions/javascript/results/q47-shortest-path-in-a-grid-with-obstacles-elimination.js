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
    const directions = [[1, 0], [-1, 0], [0, 1], [0, -1]];
    const queue = [[0, 0, k, 0]]; // [x, y, remaining_k, steps]
    const visited = new Set();
    visited.add(`0,0,${k}`);

    while (queue.length > 0) {
        const [x, y, remaining_k, steps] = queue.shift();

        if (x === m - 1 && y === n - 1) {
            return steps; // Reached the bottom-right corner
        }

        for (const [dx, dy] of directions) {
            const nx = x + dx;
            const ny = y + dy;

            if (nx >= 0 && nx < m && ny >= 0 && ny < n) {
                const new_k = remaining_k - grid[nx][ny];

                if (new_k >= 0 && !visited.has(`${nx},${ny},${new_k}`)) {
                    visited.add(`${nx},${ny},${new_k}`);
                    queue.push([nx, ny, new_k, steps + 1]);
                }
            }
        }
    }

    return -1; // No valid path found  
};
    