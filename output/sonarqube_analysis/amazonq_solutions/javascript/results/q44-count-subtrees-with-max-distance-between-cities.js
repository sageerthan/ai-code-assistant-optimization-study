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
    // Initialize the adjacency list
    const adj = new Array(n).fill(0).map(() => []);
    for (const [u, v] of edges) {
        adj[u - 1].push(v - 1);
        adj[v - 1].push(u - 1);
    }

    // Function to find the maximum distance between any two nodes in a subtree
    const maxDistance = (nodes) => {
        let maxDist = 0;
        const dfs = (node, parent) => {
            let maxDepth1 = 0, maxDepth2 = 0;
            for (const neighbor of adj[node]) {
                if (neighbor === parent) continue;
                if (!nodes[neighbor]) continue;
                const depth = dfs(neighbor, node) + 1;
                if (depth > maxDepth1) {
                    maxDepth2 = maxDepth1;
                    maxDepth1 = depth;
                } else if (depth > maxDepth2) {
                    maxDepth2 = depth;
                }
            }
            maxDist = Math.max(maxDist, maxDepth1 + maxDepth2);
            return maxDepth1;
        };
        dfs(nodes.indexOf(1), -1);
        return maxDist;
    };

    // Initialize the result array
    const res = new Array(n - 1).fill(0);

    // Function to count the number of subtrees with maximum distance d
    const count = (nodes, d) => {
        if (d === 0) return 1;
        let count = 0;
        for (let i = 0; i < n; i++) {
            if (nodes[i]) continue;
            nodes[i] = 1;
            if (maxDistance(nodes) === d) {
                count += count(nodes.slice(), d - 1);
            }
            nodes[i] = 0;
        }
        return count;
    };

    // Count the number of subtrees for each possible maximum distance
    for (let d = 1; d < n; d++) {
        res[d - 1] = count(new Array(n).fill(0), d);
    }

    return res;
};
    