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

# First generated code:

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
    

# Debugged Code

class Solution(object):
    def countSubgraphsForEachDiameter(self, n, edges):
        """
        :type n: int
        :type edges: List[List[int]]
        :rtype: List[int]
        """
        from collections import defaultdict, deque
        
        # Build adjacency list
        graph = defaultdict(list)
        for u, v in edges:
            graph[u].append(v)
            graph[v].append(u)
        
        def is_connected(mask):
            """Check if nodes in mask form a connected component"""
            # Find first node in mask
            first = -1
            for i in range(n):
                if mask & (1 << i):
                    first = i + 1
                    break
            
            if first == -1:
                return False
            
            # BFS to check connectivity
            visited = set([first])
            queue = deque([first])
            
            while queue:
                node = queue.popleft()
                for neighbor in graph[node]:
                    if neighbor not in visited and (mask & (1 << (neighbor - 1))):
                        visited.add(neighbor)
                        queue.append(neighbor)
            
            # Count nodes in mask
            count = bin(mask).count('1')
            return len(visited) == count
        
        def get_diameter(mask):
            """Get diameter of tree formed by nodes in mask"""
            # Find first node
            first = -1
            for i in range(n):
                if mask & (1 << i):
                    first = i + 1
                    break
            
            def bfs_farthest(start):
                """BFS to find farthest node from start"""
                visited = {start: 0}
                queue = deque([start])
                farthest = start
                max_dist = 0
                
                while queue:
                    node = queue.popleft()
                    for neighbor in graph[node]:
                        if neighbor not in visited and (mask & (1 << (neighbor - 1))):
                            visited[neighbor] = visited[node] + 1
                            queue.append(neighbor)
                            if visited[neighbor] > max_dist:
                                max_dist = visited[neighbor]
                                farthest = neighbor
                
                return farthest, max_dist
            
            # Two BFS passes to find diameter
            farthest1, _ = bfs_farthest(first)
            farthest2, diameter = bfs_farthest(farthest1)
            
            return diameter
        
        result = [0] * (n - 1)
        
        # Enumerate all non-empty subsets with at least 2 nodes
        for mask in range(1, 1 << n):
            node_count = bin(mask).count('1')
            
            if node_count < 2:
                continue
            
            # Check edge count: tree with k nodes has k-1 edges
            edge_count = 0
            for u, v in edges:
                if (mask & (1 << (u - 1))) and (mask & (1 << (v - 1))):
                    edge_count += 1
            
            if edge_count != node_count - 1:
                continue
            
            # Check connectivity
            if not is_connected(mask):
                continue
            
            # Calculate diameter
            diameter = get_diameter(mask)
            
            if 1 <= diameter <= n - 1:
                result[diameter - 1] += 1
        
        return result                                                      
    