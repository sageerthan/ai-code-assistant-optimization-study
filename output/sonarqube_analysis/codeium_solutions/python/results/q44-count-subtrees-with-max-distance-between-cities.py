# https://leetcode.com/problems/count-subtrees-with-max-distance-between-cities/
# Problem: Count Subtrees With Max Distance Between Cities

#Problem Description:
#There are n cities numbered from 1 to n. You are given an array edges of size n-1, where edges[i] = [ui, vi] represents a bidirectional edge between cities ui and vi. There exists a unique path between each pair of cities. In other words, the cities form a tree.
#A subtree is a subset of cities where every city is reachable from every other city in the subset, where the path between each pair passes through only the cities from the subset. Two subtrees are different if there is a city in one subtree that is not present in the other.
#For each d from 1 to n-1, find the number of subtrees in which the maximum distance between any two cities in the subtree is equal to d.
#Return an array of size n-1 where the dth element (1-indexed) is the number of subtrees in which the maximum distance between any two cities is equal to d.
#Notice that the distance between the two cities is the number of edges in the path between them.

# Constraints:
# 2 <= n <= 15
# edges.length == n-1
# edges[i].length == 2
# 1 <= ui, vi <= n
# All pairs (ui, vi) are distinct.

#Code Structure:

class Solution(object):
    def countSubgraphsForEachDiameter(self, n, edges):
        """
        :type n: int
        :type edges: List[List[int]]
        :rtype: List[int]
        """
        graph = [[] for _ in range(n+1)]
        for u, v in edges:
            graph[u].append(v)
            graph[v].append(u)

        res = [0] * (n-1)
        for i in range(1, n+1):
            depths = [0] * (n+1)
            self.dfs(i, graph, depths)
            for d in range(1, n):
                res[d-1] += depths[d] > 0
        return res

    def dfs(self, node, graph, depths):
        for i in graph[node]:
            if depths[i] == 0:
                depths[i] = depths[node] + 1
                self.dfs(i, graph, depths)
    