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
const directions = [[1, 0], [-1, 0], [0, 1], [0, -1]];
/**
 * @param {number[][]} grid
 * @param {number} k
 * @return {number}
 */
var shortestPath = function(grid, k) {
    const m = grid.length, n = grid[0].length;
    const seen = Array.from({length: m}, () => Array(n).fill(-1));
    const queue = [[0, 0, k]];
    seen[0][0] = k;
    let step = 0;
    while (queue.length) {
        const len = queue.length;
        for (let i = 0; i < len; i++) {
            const [x, y, rest] = queue.shift();
            if (x === m - 1 && y === n - 1) return step;
            for (const [dx, dy] of directions) {
                const nx = x + dx, ny = y + dy;
                if (nx >= 0 && nx < m && ny >= 0 && ny < n && rest + grid[nx][ny] >= 0 && seen[nx][ny] < rest + grid[nx][ny]) {
                    seen[nx][ny] = rest + grid[nx][ny];
                    queue.push([nx, ny, rest + grid[nx][ny]]);
                }
            }
        }
        step++;
    }
    return -1;
};
    