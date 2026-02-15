/** https://leetcode.com/problems/number-of-islands */
// Problem: Number of Islands 

//Problem Description:
//Given an m x n 2D binary grid grid which represents a map of '1's (land) and '0's (water), return the number of islands.
//An island is surrounded by water and is formed by connecting adjacent lands horizontally or vertically. You may assume all four edges of the grid are all surrounded by water.

// Constraints:
// m == grid.length
// n == grid[i].length
// 1 <= m, n <= 300
// grid[i][j] is '0' or '1'.

//Code Structure:
const directions = [[1, 0], [-1, 0], [0, 1], [0, -1]];
/**
 * @param {character[][]} grid
 * @return {number}
 */
var numIslands = function(grid) {
    let count = 0;
    for (let i = 0; i < grid.length; i++) {
        for (let j = 0; j < grid[i].length; j++) {
            if (grid[i][j] === '1') {
                dfs(grid, i, j);
                count++;
            }
        }
    }
    return count;
};

const dfs = (grid, i, j) => {
    if (i < 0 || j < 0 || i >= grid.length || j >= grid[i].length || grid[i][j] !== '1') {
        return;
    }
    grid[i][j] = '0';
    for (const [dx, dy] of directions) {
        dfs(grid, i + dx, j + dy);
    }
};
    