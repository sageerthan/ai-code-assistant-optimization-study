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

// First generated code

// class Solution {

//     /**
//      * @param Integer $n
//      * @param Integer[][] $edges
//      * @return Integer[]
//      */
//     function countSubgraphsForEachDiameter($n, $edges) {
//         $graph = array_fill(0, $n, array_fill(0, $n, 0));
//         foreach ($edges as $edge) {
//             $graph[$edge[0]][$edge[1]] = 1;
//             $graph[$edge[1]][$edge[0]] = 1;
//         }
//         $res = array_fill(0, $n-1, 0);
//         for ($i = 1; $i <= $n; $i++) {
//             $depths = array_fill(0, $n, 0);
//             $this->dfs($i, $graph, $depths);
//             foreach ($depths as $d) {
//                 if ($d > 0) $res[$d-1]++;
//             }
//         }
//         return $res;
//     }
    
//     private function dfs($node, $graph, &$depths) {
//         foreach ($graph[$node] as $next => $v) {
//             if ($v === 1 && $depths[$next] === 0) {
//                 $depths[$next] = $depths[$node] + 1;
//                 $this->dfs($next, $graph, $depths);
//             }
//         }
//     }
// }

// Debugged Code

class Solution {

    /**
     * @param Integer $n
     * @param Integer[][] $edges
     * @return Integer[]
     */
    function countSubgraphsForEachDiameter($n, $edges) {
        $graph = array_fill(0, $n, array_fill(0, $n, 0));
        foreach ($edges as $edge) {
            $graph[$edge[0]][$edge[1]] = 1;
            $graph[$edge[1]][$edge[0]] = 1;
        }
        $res = array_fill(0, $n-1, 0);
        for ($i = 1; $i <= $n; $i++) {
            $depths = array_fill(0, $n, 0);
            $this->dfs($i, $graph, $depths);
            $unique = array_unique($depths);
            foreach ($unique as $d) {
                if ($d > 0) $res[$d-1]++;
            }
        }
        return $res;
    }

    function dfs($node, $graph, &$depths) {
        $depths[$node] = 0;
        foreach ($graph[$node] as $neighbor) {
            if ($depths[$neighbor] == 0) {
                $this->dfs($neighbor, $graph, $depths);
                $depths[$node] = max($depths[$node], $depths[$neighbor] + 1);
            }
        }
    }
}
    