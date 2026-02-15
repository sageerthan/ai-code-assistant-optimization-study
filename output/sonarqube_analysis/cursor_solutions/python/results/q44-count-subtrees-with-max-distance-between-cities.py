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
        # Build adjacency list
        graph = [[] for _ in range(n + 1)]
        for u, v in edges:
            graph[u].append(v)
            graph[v].append(u)
        
        result = [0] * (n - 1)
        
        # Try all possible subsets of cities
        for mask in range(1, 1 << n):
            cities = []
            for i in range(n):
                if mask & (1 << i):
                    cities.append(i + 1)
            
            if len(cities) < 2:
                continue
            
            # Check if this subset forms a connected subtree
            if self.isConnectedSubtree(cities, graph):
                diameter = self.getDiameter(cities, graph)
                if diameter > 0:
                    result[diameter - 1] += 1
        
        return result
    
    def isConnectedSubtree(self, cities, graph):
        """
        Check if the given cities form a connected subtree
        """
        if not cities:
            return False
        
        # BFS to check connectivity
        visited = set()
        queue = [cities[0]]
        visited.add(cities[0])
        
        while queue:
            node = queue.pop(0)
            for neighbor in graph[node]:
                if neighbor in cities and neighbor not in visited:
                    visited.add(neighbor)
                    queue.append(neighbor)
        
        return len(visited) == len(cities)
    
    def getDiameter(self, cities, graph):
        """
        Get the diameter of the subtree formed by the given cities
        """
        if len(cities) < 2:
            return 0
        
        max_diameter = 0
        
        # Try all pairs of cities as endpoints
        for i in range(len(cities)):
            for j in range(i + 1, len(cities)):
                start, end = cities[i], cities[j]
                distance = self.bfsDistance(start, end, cities, graph)
                max_diameter = max(max_diameter, distance)
        
        return max_diameter
    
    def bfsDistance(self, start, end, cities, graph):
        """
        Find shortest distance between start and end in the subtree
        """
        if start == end:
            return 0
        
        visited = set()
        queue = [(start, 0)]
        visited.add(start)
        
        while queue:
            node, dist = queue.pop(0)
            for neighbor in graph[node]:
                if neighbor in cities and neighbor not in visited:
                    if neighbor == end:
                        return dist + 1
                    visited.add(neighbor)
                    queue.append((neighbor, dist + 1))
        
        return 0
    