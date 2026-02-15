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
        List<Integer>[] graph = new List[n+1];
        for (int i = 1; i <= n; i++) graph[i] = new ArrayList<>();
        for (int[] edge : edges) {
            graph[edge[0]].add(edge[1]);
            graph[edge[1]].add(edge[0]);
        }
        int[] res = new int[n-1];
        for (int i = 1; i <= n; i++) {
            int[] depths = new int[n+1];
            dfs(i, graph, depths);
            for (int j = 1; j <= n-1; j++) res[j-1] += depths[j] > 0 ? 1 : 0;
        }
        return res;
    }
    
    private void dfs(int node, List<Integer>[] graph, int[] depths) {
        for (int next : graph[node]) {
            if (depths[next] == 0) {
                depths[next] = depths[node] + 1;
                dfs(next, graph, depths);
            }
        }
    }
}

// Debugged Code

import java.util.*;

class Solution {
    public int[] findEquationValue(int n, int[][] edges, int[] node) {
        Map<Integer, List<Integer>> graph = new HashMap<>();
        for (int[] edge : edges) {
            int u = edge[0], v = edge[1];
            graph.putIfAbsent(u, new ArrayList<>());
            graph.get(u).add(v);
            graph.putIfAbsent(v, new ArrayList<>());
            graph.get(v).add(u);
        }
        int[] result = new int[n];
        Arrays.fill(result, -1);
        for (int i = 0; i < n; i++) {
            if (result[i] != -1) {
                continue;
            }
            Queue<Integer> queue = new LinkedList<>();
            queue.offer(i);
            result[i] = node[i];
            while (!queue.isEmpty()) {
                int nodeIndex = queue.poll();
                for (int neighbor : graph.get(nodeIndex)) {
                    if (result[neighbor] == -1) {
                        result[neighbor] = result[nodeIndex];
                        queue.offer(neighbor);
                    } else if (result[neighbor] != result[nodeIndex]) {
                        if (result[neighbor] != node[neighbor]) {
                            return new int[]{-1};
                        }
                        result[nodeIndex] = result[neighbor];
                        queue.offer(nodeIndex);
                    }
                }
            }
        }
        return result;
    }
}