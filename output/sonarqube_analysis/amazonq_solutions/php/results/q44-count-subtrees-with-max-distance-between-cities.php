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
        $graph = array_fill(0, $n, []);
        foreach ($edges as $edge) {
            $u = $edge[0] - 1;
            $v = $edge[1] - 1;
            $graph[$u][] = $v;
            $graph[$v][] = $u;
        }
        
        $result = array_fill(0, $n - 1, 0);
        
        for ($mask = 1; $mask < (1 << $n); $mask++) {
            $cities = [];
            for ($i = 0; $i < $n; $i++) {
                if ($mask & (1 << $i)) {
                    $cities[] = $i;
                }
            }
            
            if (count($cities) < 2) continue;
            
            if ($this->isConnected($cities, $graph)) {
                $maxDist = $this->getMaxDistance($cities, $graph);
                if ($maxDist > 0) {
                    $result[$maxDist - 1]++;
                }
            }
        }
        
        return $result;
    }
    
    private function isConnected($cities, $graph) {
        if (count($cities) <= 1) return true;
        
        $visited = [];
        $queue = [$cities[0]];
        $visited[$cities[0]] = true;
        $count = 1;
        
        while (!empty($queue)) {
            $node = array_shift($queue);
            foreach ($graph[$node] as $neighbor) {
                if (in_array($neighbor, $cities) && !isset($visited[$neighbor])) {
                    $visited[$neighbor] = true;
                    $queue[] = $neighbor;
                    $count++;
                }
            }
        }
        
        return $count == count($cities);
    }
    
    private function getMaxDistance($cities, $graph) {
        $maxDist = 0;
        
        foreach ($cities as $start) {
            $dist = $this->bfs($start, $cities, $graph);
            $maxDist = max($maxDist, max($dist));
        }
        
        return $maxDist;
    }
    
    private function bfs($start, $cities, $graph) {
        $dist = [];
        $queue = [$start];
        $dist[$start] = 0;
        
        while (!empty($queue)) {
            $node = array_shift($queue);
            foreach ($graph[$node] as $neighbor) {
                if (in_array($neighbor, $cities) && !isset($dist[$neighbor])) {
                    $dist[$neighbor] = $dist[$node] + 1;
                    $queue[] = $neighbor;
                }
            }
        }
        
        return $dist;
    }
}
    