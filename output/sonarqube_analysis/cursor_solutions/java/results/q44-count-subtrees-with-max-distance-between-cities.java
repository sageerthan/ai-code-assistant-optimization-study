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

import java.util.*;

class Solution {
    public int[] countSubgraphsForEachDiameter(int n, int[][] edges) {
        // Build adjacency list
        List<List<Integer>> graph = new ArrayList<>();
        for (int i = 0; i <= n; i++) {
            graph.add(new ArrayList<>());
        }
        
        for (int[] edge : edges) {
            graph.get(edge[0]).add(edge[1]);
            graph.get(edge[1]).add(edge[0]);
        }
        
        int[] result = new int[n - 1];
        
        // Try all possible subsets of cities (2^n possibilities)
        for (int mask = 1; mask < (1 << n); mask++) {
            List<Integer> cities = new ArrayList<>();
            for (int i = 1; i <= n; i++) {
                if ((mask & (1 << (i - 1))) != 0) {
                    cities.add(i);
                }
            }
            
            if (cities.size() < 2) continue;
            
            // Check if this subset forms a valid subtree
            if (isValidSubtree(cities, graph)) {
                int maxDistance = getMaxDistance(cities, graph);
                if (maxDistance > 0 && maxDistance <= n - 1) {
                    result[maxDistance - 1]++;
                }
            }
        }
        
        return result;
    }
    
    private boolean isValidSubtree(List<Integer> cities, List<List<Integer>> graph) {
        // Check if all cities in the subset are connected
        Set<Integer> citySet = new HashSet<>(cities);
        Set<Integer> visited = new HashSet<>();
        Queue<Integer> queue = new LinkedList<>();
        
        queue.offer(cities.get(0));
        visited.add(cities.get(0));
        
        while (!queue.isEmpty()) {
            int current = queue.poll();
            for (int neighbor : graph.get(current)) {
                if (citySet.contains(neighbor) && !visited.contains(neighbor)) {
                    visited.add(neighbor);
                    queue.offer(neighbor);
                }
            }
        }
        
        return visited.size() == cities.size();
    }
    
    private int getMaxDistance(List<Integer> cities, List<List<Integer>> graph) {
        int maxDistance = 0;
        Set<Integer> citySet = new HashSet<>(cities);
        
        // For each city, find the maximum distance to any other city in the subset
        for (int start : cities) {
            int distance = bfs(start, citySet, graph);
            maxDistance = Math.max(maxDistance, distance);
        }
        
        return maxDistance;
    }
    
    private int bfs(int start, Set<Integer> citySet, List<List<Integer>> graph) {
        Queue<Integer> queue = new LinkedList<>();
        Map<Integer, Integer> distance = new HashMap<>();
        
        queue.offer(start);
        distance.put(start, 0);
        
        int maxDist = 0;
        
        while (!queue.isEmpty()) {
            int current = queue.poll();
            int currentDist = distance.get(current);
            
            for (int neighbor : graph.get(current)) {
                if (citySet.contains(neighbor) && !distance.containsKey(neighbor)) {
                    distance.put(neighbor, currentDist + 1);
                    queue.offer(neighbor);
                    maxDist = Math.max(maxDist, currentDist + 1);
                }
            }
        }
        
        return maxDist;
    }
}
    