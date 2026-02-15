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

// First generated code

class Solution {
    public int[] countSubgraphsForEachDiameter(int n, int[][] edges) {
        int[] res = new int[n - 1];
        int[][] graph = new int[n][n];
        for (int[] edge : edges) {
            graph[edge[0] - 1][edge[1] - 1] = 1;
            graph[edge[1] - 1][edge[0] - 1] = 1;
        }
        for (int i = 0; i < n; i++) {
            graph[i][i] = 1;
        }
        for (int i = 1; i <= n - 1; i++) {
            boolean[] visited = new boolean[n];
            dfs(graph, visited, 0, i, res);
        }
        return res;
        
    }
}

// Debugged Code
    
class Solution {
    public int[] countSubgraphsForEachDiameter(int n, int[][] edges) {
        int[] res = new int[n - 1];
        int[][] graph = new int[n][n];
        for (int[] edge : edges) {
            graph[edge[0] - 1][edge[1] - 1] = 1;
            graph[edge[1] - 1][edge[0] - 1] = 1;
        }
        
        for (int mask = 1; mask < (1 << n); mask++) {
            if (Integer.bitCount(mask) < 2) continue;
            int maxDist = getMaxDistance(graph, mask, n);
            if (maxDist > 0) res[maxDist - 1]++;
        }
        return res;
    }
    
    private int getMaxDistance(int[][] graph, int mask, int n) {
        int[] cities = new int[Integer.bitCount(mask)];
        int idx = 0;
        for (int i = 0; i < n; i++) {
            if ((mask & (1 << i)) != 0) cities[idx++] = i;
        }
        
        if (!isConnected(graph, cities)) return -1;
        
        int maxDist = 0;
        for (int i = 0; i < cities.length; i++) {
            for (int j = i + 1; j < cities.length; j++) {
                maxDist = Math.max(maxDist, bfs(graph, cities[i], cities[j], mask));
            }
        }
        return maxDist;
    }
    
    private boolean isConnected(int[][] graph, int[] cities) {
        boolean[] visited = new boolean[cities.length];
        dfs(graph, cities, visited, 0);
        for (boolean v : visited) {
            if (!v) return false;
        }
        return true;
    }
    
    private void dfs(int[][] graph, int[] cities, boolean[] visited, int idx) {
        visited[idx] = true;
        for (int i = 0; i < cities.length; i++) {
            if (!visited[i] && graph[cities[idx]][cities[i]] == 1) {
                dfs(graph, cities, visited, i);
            }
        }
    }
    
    private int bfs(int[][] graph, int start, int end, int mask) {
        if (start == end) return 0;
        boolean[] visited = new boolean[graph.length];
        int[] queue = new int[graph.length];
        int front = 0, rear = 0;
        queue[rear++] = start;
        visited[start] = true;
        int dist = 0;
        
        while (front < rear) {
            int size = rear - front;
            dist++;
            for (int i = 0; i < size; i++) {
                int curr = queue[front++];
                for (int next = 0; next < graph.length; next++) {
                    if (graph[curr][next] == 1 && !visited[next] && (mask & (1 << next)) != 0) {
                        if (next == end) return dist;
                        visited[next] = true;
                        queue[rear++] = next;
                    }
                }
            }
        }
        return -1;
    }
}
    