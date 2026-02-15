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


// Debugged Code:

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
    
    private boolean isValidTree(int mask, int[][] edges, int n) {
        // Check if the subset of nodes forms a connected tree
        int[] adj = new int[n];
        int count = 0;
        
        for (int[] edge : edges) {
            int u = edge[0] - 1;
            int v = edge[1] - 1;
            if (((mask >> u) & 1) == 1 && ((mask >> v) & 1) == 1) {
                adj[u]++;
                adj[v]++;
                count++;
            }
        }
        
        // A tree with k nodes has k-1 edges
        int nodeCount = Integer.bitCount(mask);
        if (count != nodeCount - 1) return false;
        
        // Check connectivity using DFS
        boolean[] visited = new boolean[n];
        int first = -1;
        for (int i = 0; i < n; i++) {
            if ((mask >> i) & 1) == 1) {
                first = i;
                break;
            }
        }
        
        dfs(first, mask, edges, visited);
        
        for (int i = 0; i < n; i++) {
            if (((mask >> i) & 1) == 1 && !visited[i]) {
                return false;
            }
        }
        return true;
    }
    
    private void dfs(int node, int mask, int[][] edges, boolean[] visited) {
        visited[node] = true;
        for (int[] edge : edges) {
            int u = edge[0] - 1;
            int v = edge[1] - 1;
            
            if (u == node && !visited[v] && ((mask >> v) & 1) == 1) {
                dfs(v, mask, edges, visited);
            } else if (v == node && !visited[u] && ((mask >> u) & 1) == 1) {
                dfs(u, mask, edges, visited);
            }
        }
    }
    
    private int calculateDiameter(int mask, int[][] edges, int n) {
        // Find the diameter of the tree formed by the subset
        int maxDiameter = 0;
        
        // For each node in the subset, find the farthest node
        for (int i = 0; i < n; i++) {
            if (((mask >> i) & 1) == 1) {
                int[] dist = new int[n];
                bfs(i, mask, edges, dist);
                
                for (int j = 0; j < n; j++) {
                    if (((mask >> j) & 1) == 1) {
                        maxDiameter = Math.max(maxDiameter, dist[j]);
                    }
                }
            }
        }
        
        return maxDiameter;
    }
    
    private void bfs(int start, int mask, int[][] edges, int[] dist) {
        java.util.Queue<Integer> queue = new java.util.LinkedList<>();
        boolean[] visited = new boolean[dist.length];
        
        queue.offer(start);
        visited[start] = true;
        dist[start] = 0;
        
        while (!queue.isEmpty()) {
            int node = queue.poll();
            for (int[] edge : edges) {
                int u = edge[0] - 1;
                int v = edge[1] - 1;
                
                if (u == node && !visited[v] && ((mask >> v) & 1) == 1) {
                    visited[v] = true;
                    dist[v] = dist[node] + 1;
                    queue.offer(v);
                } else if (v == node && !visited[u] && ((mask >> u) & 1) == 1) {
                    visited[u] = true;
                    dist[u] = dist[node] + 1;
                    queue.offer(u);
                }
            }
        }
    }
}
    