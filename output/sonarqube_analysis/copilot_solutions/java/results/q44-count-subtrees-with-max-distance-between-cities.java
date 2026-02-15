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

class Solution {
    public int[] countSubgraphsForEachDiameter(int n, int[][] edges) {
        int[] result = new int[n - 1];
        int totalSubtrees = 1 << n; // Total possible subsets of nodes

        for (int mask = 1; mask < totalSubtrees; mask++) {
            int count = Integer.bitCount(mask); // Count of nodes in the subset
            if (count < 2) continue; // Skip subsets with less than 2 nodes

            // Check if the subset forms a valid tree
            if (isValidTree(mask, edges, n)) {
                int diameter = calculateDiameter(mask, edges, n);
                if (diameter > 0 && diameter <= n - 1) {
                    result[diameter - 1]++;
                }
            }
        }
        return result; 
    }
}
    