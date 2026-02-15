/** https://leetcode.com/problems/count-subtrees-with-max-distance-between-cities */
// Problem: Count Subtrees With Max Distance Between Cities

//Problem Description:
//There are n cities numbered from 1 to n. You are given an array edges of size n-1, where edges[i] = [ui, vi] represents a bidirectional edge between cities ui and vi. There exists a unique path between each pair of cities. In other words, the cities form a tree.
//A subtree is a subset of cities where every city is reachable from every other city in the subset, where the path between each pair passes through only the cities from the subset. Two subtrees are different if there is a city in one subtree that is not present in the other.
//For each d from 1 to n-1, find the number of subtrees in which the maximum distance between any two cities in the subtree is equal to d.
//Return an array of size n-1 where the dth element (1-indexed) is the number of subtrees in which the maximum distance between any two cities is equal to d.
//Notice that the distance between the two cities is the number of edges in the path between them.

// Constraints:
// 2 <= n <= 15
// edges.length == n-1
// edges[i].length == 2
// 1 <= ui, vi <= n
// All pairs (ui, vi) are distinct.

//Code Structure:

/**
 * @param {number} n
 * @param {number[][]} edges
 * @return {number[]}
 */
var countSubgraphsForEachDiameter = function(n, edges) {
    let graph = Array(n).fill(0).map(() => new Set());
    for (let [u, v] of edges) {
        graph[u-1].add(v-1);
        graph[v-1].add(u-1);
    }
    let res = Array(n-1).fill(0);
    for (let i = 0; i < n; i++) {
        let depths = Array(n).fill(0);
        dfs(i, graph, depths);
        for (let j = 1; j < n; j++) res[j-1] += depths[j] > 0 ? 1 : 0;
    }
    return res;
};
function dfs(node, graph, depths) {
    for (let next of graph[node]) {
        if (depths[next] === 0) {
            depths[next] = depths[node] + 1;
            dfs(next, graph, depths);
        }
    }
}
    