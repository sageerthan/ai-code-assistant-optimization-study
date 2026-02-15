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

# First generated code

import collections
class Solution(object):
    def countSubgraphsForEachDiameter(self, n, edges):
        """
        :type n: int
        :type edges: List[List[int]]
        :rtype: List[int]
        """
        graph = collections.defaultdict(list)
        for u, v in edges:
            graph[u].append(v)
            graph[v].append(u)

        def dfs(mask, u, parent):
            mask ^= 1 << u
            max_depth = 0
            for v in graph[u]:
                if mask & (1 << v) and v != parent:
                    depth = dfs(mask, v, u)
                    if max_depth == 0:
                        max_depth = depth
                    elif depth != 0:
                        max_depth = max(max_depth, depth)
            return max_depth + 1

        def get_diameter(mask):
            if mask == 0:
                return 0
            max_depth = 0
            for u in range(n):
                if mask & (1 << u):
                    depth = dfs(mask, u, -1)
                    if max_depth == 0:
                        max_depth = depth
                    elif depth != 0:
                        max_depth = max(max_depth, depth)
                    break
            return max_depth - 1

        result = [0] * (n - 1)
        for mask in range(1, 1 << n):
            diameter = get_diameter(mask)
            if diameter > 0:
                result[diameter - 1] += 1
        return result                                                      
    

# Debugged Code

from collections import defaultdict, deque

class Solution(object):
    def countSubgraphsForEachDiameter(self, n, edges):
        """
        :type n: int
        :type edges: List[List[int]]
        :rtype: List[int]
        """
        graph = defaultdict(list)
        for u, v in edges:
            graph[u-1].append(v-1)
            graph[v-1].append(u-1)
        
        result = [0] * (n - 1)
        
        for mask in range(1, 1 << n):
            if bin(mask).count('1') < 2:
                continue
            
            cities = [i for i in range(n) if mask & (1 << i)]
            
            if not self.isConnected(cities, graph, mask):
                continue
            
            max_dist = self.getMaxDistance(cities, graph)
            if max_dist > 0:
                result[max_dist - 1] += 1
        
        return result
    
    def isConnected(self, cities, graph, mask):
        if not cities:
            return False
        
        visited = set()
        queue = deque([cities[0]])
        visited.add(cities[0])
        
        while queue:
            node = queue.popleft()
            for neighbor in graph[node]:
                if (mask & (1 << neighbor)) and neighbor not in visited:
                    visited.add(neighbor)
                    queue.append(neighbor)
        
        return len(visited) == len(cities)
    
    def getMaxDistance(self, cities, graph):
        max_dist = 0
        
        for i in range(len(cities)):
            for j in range(i + 1, len(cities)):
                dist = self.bfs(cities[i], cities[j], graph, set(cities))
                max_dist = max(max_dist, dist)
        
        return max_dist
    
    def bfs(self, start, end, graph, city_set):
        if start == end:
            return 0
        
        visited = set([start])
        queue = deque([start])
        dist = 0
        
        while queue:
            size = len(queue)
            dist += 1
            
            for _ in range(size):
                curr = queue.popleft()
                
                for neighbor in graph[curr]:
                    if neighbor == end:
                        return dist
                    if neighbor in city_set and neighbor not in visited:
                        visited.add(neighbor)
                        queue.append(neighbor)
        
        return -1                                                      
    