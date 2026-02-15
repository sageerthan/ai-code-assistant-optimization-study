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
     * For each possible diameter d (1 to n-1), count the number of connected subtrees
     * whose maximum distance between any two nodes is exactly d.
     * Uses bitmask to enumerate all subsets and BFS to check connectivity and compute diameter.
     * @param Integer $n
     * @param Integer[][] $edges
     * @return Integer[]
     */
    function countSubgraphsForEachDiameter($n, $edges) {
        // Build adjacency list (0-indexed)
        $adj = array_fill(0, $n, []);
        foreach ($edges as $e) {
            $u = $e[0] - 1;
            $v = $e[1] - 1;
            $adj[$u][] = $v;
            $adj[$v][] = $u;
        }

        $res = array_fill(0, $n - 1, 0);

        // Enumerate all subsets with at least 2 nodes
        for ($mask = 1; $mask < (1 << $n); $mask++) {
            if (self::bitCount($mask) < 2) continue;

            // Get nodes in this subset
            $nodes = [];
            for ($i = 0; $i < $n; $i++) {
                if ($mask & (1 << $i)) $nodes[] = $i;
            }

            // Check if the subset is connected using BFS
            $visited = [];
            $queue = [$nodes[0]];
            $visited[$nodes[0]] = true;
            $cnt = 1;
            while ($queue) {
                $cur = array_shift($queue);
                foreach ($adj[$cur] as $nei) {
                    if (($mask & (1 << $nei)) && !isset($visited[$nei])) {
                        $visited[$nei] = true;
                        $queue[] = $nei;
                        $cnt++;
                    }
                }
            }
            if ($cnt != count($nodes)) continue; // Not connected

            // Find the diameter of the subtree (two BFS)
            $farthest = self::bfsFarthest($nodes[0], $mask, $adj, $n);
            $diameter = self::bfsFarthest($farthest['node'], $mask, $adj, $n)['dist'];
            if ($diameter > 0 && $diameter <= $n - 1) {
                $res[$diameter - 1]++;
            }
        }
        return $res;
    }

    // Helper: Count number of set bits in mask
    private static function bitCount($x) {
        $count = 0;
        while ($x) {
            $count += $x & 1;
            $x >>= 1;
        }
        return $count;
    }

    // Helper: BFS to find farthest node and its distance in the subset
    private static function bfsFarthest($start, $mask, &$adj, $n) {
        $visited = array_fill(0, $n, false);
        $queue = [[$start, 0]];
        $visited[$start] = true;
        $farthest = ['node' => $start, 'dist' => 0];
        while ($queue) {
            list($cur, $d) = array_shift($queue);
            if ($d > $farthest['dist']) {
                $farthest = ['node' => $cur, 'dist' => $d];
            }
            foreach ($adj[$cur] as $nei) {
                if (($mask & (1 << $nei)) && !$visited[$nei]) {
                    $visited[$nei] = true;
                    $queue[] = [$nei, $d + 1];
                }
            }
        }
        return $farthest;
    }
}
    