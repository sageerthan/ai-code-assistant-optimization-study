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
        from collections import defaultdict
        
        # Build the adjacency list for the tree
        graph = defaultdict(list)
        for u, v in edges:
            graph[u].append(v)
            graph[v].append(u)
        
        def dfs(node, parent):
            max_depth = 0
            second_max_depth = 0
            
            for neighbor in graph[node]:
                if neighbor == parent:
                    continue
                depth = dfs(neighbor, node) + 1
                if depth > max_depth:
                    second_max_depth = max_depth
                    max_depth = depth
                elif depth > second_max_depth:
                    second_max_depth = depth
            
            return max_depth
        
        result = [0] * (n - 1)
        
        for i in range(1, 1 << n):
            nodes_in_subtree = []
            for j in range(n):
                if i & (1 << j):
                    nodes_in_subtree.append(j + 1)
            
            if len(nodes_in_subtree) < 2:
                continue
            
            # Check if the subtree is valid
            valid = True
            for u in nodes_in_subtree:
                for v in graph[u]:
                    if v not in nodes_in_subtree:
                        valid = False
                        break
                if not valid:
                    break
            
            if not valid:
                continue
            
            # Calculate the diameter of the subtree
            max_diameter = 0
            for node in nodes_in_subtree:
                max_diameter = max(max_diameter, dfs(node, -1))
            
            if max_diameter > 0:
                result[max_diameter - 1] += 1
        
        return result                                                      
    