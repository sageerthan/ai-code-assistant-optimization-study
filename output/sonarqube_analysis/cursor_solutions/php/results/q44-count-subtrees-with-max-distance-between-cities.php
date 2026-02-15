<?php
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

    /**
     * @param Integer $n
     * @param Integer[][] $edges
     * @return Integer[]
     */
    function countSubgraphsForEachDiameter($n, $edges) {
        // Build adjacency list
        $graph = array_fill(0, $n, []);
        foreach ($edges as $edge) {
            $u = $edge[0] - 1; // Convert to 0-indexed
            $v = $edge[1] - 1;
            $graph[$u][] = $v;
            $graph[$v][] = $u;
        }
        
        $result = array_fill(0, $n - 1, 0);
        
        // Try all possible subtrees using bitmask
        for ($mask = 1; $mask < (1 << $n); $mask++) {
            $nodes = [];
            for ($i = 0; $i < $n; $i++) {
                if ($mask & (1 << $i)) {
                    $nodes[] = $i;
                }
            }
            
            if (count($nodes) < 2) {
                continue;
            }
            
            // Check if this is a valid connected subtree
            if ($this->isConnectedSubtree($graph, $nodes)) {
                $diameter = $this->getDiameter($graph, $nodes);
                if ($diameter > 0 && $diameter <= $n - 1) {
                    $result[$diameter - 1]++;
                }
            }
        }
        
        return $result;
    }
    
    private function isConnectedSubtree($graph, $nodes) {
        if (empty($nodes)) {
            return false;
        }
        
        $visited = array_fill(0, count($graph), false);
        $start = $nodes[0];
        $queue = [$start];
        $visited[$start] = true;
        $count = 1;
        
        while (!empty($queue)) {
            $current = array_shift($queue);
            
            foreach ($graph[$current] as $neighbor) {
                if (in_array($neighbor, $nodes) && !$visited[$neighbor]) {
                    $visited[$neighbor] = true;
                    $queue[] = $neighbor;
                    $count++;
                }
            }
        }
        
        return $count === count($nodes);
    }
    
    private function getDiameter($graph, $nodes) {
        if (count($nodes) < 2) {
            return 0;
        }
        
        $maxDist = 0;
        
        // Try BFS from each node to find the maximum distance
        foreach ($nodes as $start) {
            $distances = $this->bfs($graph, $start, $nodes);
            $maxDist = max($maxDist, max($distances));
        }
        
        return $maxDist;
    }
    
    private function bfs($graph, $start, $nodes) {
        $distances = array_fill(0, count($graph), -1);
        $queue = [$start];
        $distances[$start] = 0;
        
        while (!empty($queue)) {
            $current = array_shift($queue);
            
            foreach ($graph[$current] as $neighbor) {
                if (in_array($neighbor, $nodes) && $distances[$neighbor] === -1) {
                    $distances[$neighbor] = $distances[$current] + 1;
                    $queue[] = $neighbor;
                }
            }
        }
        
        return $distances;
    }
}
    