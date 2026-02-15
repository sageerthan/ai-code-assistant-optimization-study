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
    // Build adjacency list
    const graph = Array(n + 1).fill().map(() => []);
    
    for (const [u, v] of edges) {
        graph[u].push(v);
        graph[v].push(u);
    }
    
    const result = Array(n - 1).fill(0);
    
    // Try all possible subsets of cities (2^n possibilities)
    for (let mask = 1; mask < (1 << n); mask++) {
        const cities = [];
        for (let i = 1; i <= n; i++) {
            if (mask & (1 << (i - 1))) {
                cities.push(i);
            }
        }
        
        if (cities.length < 2) continue;
        
        // Check if this subset forms a valid subtree
        if (isValidSubtree(cities, graph)) {
            const maxDistance = getMaxDistance(cities, graph);
            if (maxDistance > 0 && maxDistance <= n - 1) {
                result[maxDistance - 1]++;
            }
        }
    }
    
    return result;
};

function isValidSubtree(cities, graph) {
    // Check if all cities in the subset are connected
    const citySet = new Set(cities);
    const visited = new Set();
    const queue = [cities[0]];
    
    visited.add(cities[0]);
    
    while (queue.length > 0) {
        const current = queue.shift();
        for (const neighbor of graph[current]) {
            if (citySet.has(neighbor) && !visited.has(neighbor)) {
                visited.add(neighbor);
                queue.push(neighbor);
            }
        }
    }
    
    return visited.size === cities.length;
}

function getMaxDistance(cities, graph) {
    let maxDistance = 0;
    const citySet = new Set(cities);
    
    // For each city, find the maximum distance to any other city in the subset
    for (const start of cities) {
        const distance = bfs(start, citySet, graph);
        maxDistance = Math.max(maxDistance, distance);
    }
    
    return maxDistance;
}

function bfs(start, citySet, graph) {
    const queue = [start];
    const distance = { [start]: 0 };
    
    let maxDist = 0;
    
    while (queue.length > 0) {
        const current = queue.shift();
        const currentDist = distance[current];
        
        for (const neighbor of graph[current]) {
            if (citySet.has(neighbor) && !(neighbor in distance)) {
                distance[neighbor] = currentDist + 1;
                queue.push(neighbor);
                maxDist = Math.max(maxDist, currentDist + 1);
            }
        }
    }
    
    return maxDist;
}
    