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

// First generated code:

/**
 * @param {number} n
 * @param {number[][]} edges
 * @return {number[]}
 */
var countSubgraphsForEachDiameter = function(n, edges) {
    const result = new Array(n - 1).fill(0);
    const graph = Array.from({ length: n + 1 }, () => []);

    for (const [u, v] of edges) {
        graph[u].push(v);
        graph[v].push(u);
    }

    const dfs = (node, parent) => {
        let maxDepth = 0;
        let secondMaxDepth = 0;

        for (const neighbor of graph[node]) {
            if (neighbor === parent) continue;
            const depth = dfs(neighbor, node);
            if (depth > maxDepth) {
                secondMaxDepth = maxDepth;
                maxDepth = depth;
            } else if (depth > secondMaxDepth) {
                secondMaxDepth = depth;
            }
        }

        const diameter = maxDepth + secondMaxDepth;
        if (diameter > 0) result[diameter - 1]++;
        return maxDepth + 1;
    };

    dfs(1, -1);
    return result;
};
    

// Debugged Code:

/**
 * @param {number} n
 * @param {number[][]} edges
 * @return {number[]}
 */
var countSubgraphsForEachDiameter = function(n, edges) {
    const result = new Array(n - 1).fill(0);
    const graph = Array.from({ length: n + 1 }, () => []);

    for (const [u, v] of edges) {
        graph[u].push(v);
        graph[v].push(u);
    }

    const popcount = (x) => {
        let c = 0;
        while (x) {
            c += x & 1;
            x >>= 1;
        }
        return c;
    };

    const getFirstNode = (mask) => {
        for (let i = 0; i < n; i++) if ((mask >> i) & 1) return i + 1;
        return -1;
    };

    const isValidTree = (mask) => {
        const nodeCount = popcount(mask);
        if (nodeCount < 2) return false;
        // count edges inside mask
        let edgeCount = 0;
        for (const [u, v] of edges) {
            if (((mask >> (u - 1)) & 1) && ((mask >> (v - 1)) & 1)) edgeCount++;
        }
        if (edgeCount !== nodeCount - 1) return false;
        // connectivity check via BFS
        const start = getFirstNode(mask);
        const visited = new Array(n + 1).fill(false);
        const q = [start];
        visited[start] = true;
        let cnt = 1;
        while (q.length) {
            const cur = q.shift();
            for (const nei of graph[cur]) {
                if (!visited[nei] && ((mask >> (nei - 1)) & 1)) {
                    visited[nei] = true;
                    q.push(nei);
                    cnt++;
                }
            }
        }
        return cnt === nodeCount;
    };

    const bfsFarthest = (start, mask) => {
        const dist = new Array(n + 1).fill(-1);
        const q = [start];
        dist[start] = 0;
        let farNode = start;
        while (q.length) {
            const cur = q.shift();
            for (const nei of graph[cur]) {
                if (dist[nei] === -1 && ((mask >> (nei - 1)) & 1)) {
                    dist[nei] = dist[cur] + 1;
                    q.push(nei);
                    if (dist[nei] > dist[farNode]) farNode = nei;
                }
            }
        }
        return { farNode, dist };
    };

    const calculateDiameter = (mask) => {
        const start = getFirstNode(mask);
        const first = bfsFarthest(start, mask);
        const second = bfsFarthest(first.farNode, mask);
        // maximum distance between any two nodes in the subset
        let maxd = 0;
        for (let i = 1; i <= n; i++) {
            if (((mask >> (i - 1)) & 1) && second.dist[i] > maxd) maxd = second.dist[i];
        }
        return maxd;
    };

    const totalMasks = 1 << n;
    for (let mask = 1; mask < totalMasks; mask++) {
        if (popcount(mask) < 2) continue;
        if (!isValidTree(mask)) continue;
        const d = calculateDiameter(mask);
        if (d >= 1 && d <= n - 1) result[d - 1]++;
    }

    return result;
};
    