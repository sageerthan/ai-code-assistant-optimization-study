<?php
/** https://leetcode.com/problems/clone-graph */
// Problem: Clone Graph 

//Problem Description:
//Given a reference of a node in a connected undirected graph.
//Return a deep copy (clone) of the graph.
// Each node in the graph contains a value (int) and a list (List[Node]) of its neighbors.

// class Node {
//     public int val;
//     public List<Node> neighbors;
// }
 

// Test case format:

// For simplicity, each node's value is the same as the node's index (1-indexed). For example, the first node with val == 1, the second node with val == 2, and so on. The graph is represented in the test case using an adjacency list.

// An adjacency list is a collection of unordered lists used to represent a finite graph. Each list describes the set of neighbors of a node in the graph.

// The given node will always be the first node with val = 1. You must return the copy of the given node as a reference to the cloned graph.

// Constraints:
// The number of nodes in the graph is in the range [0, 100].
// 1 <= Node.val <= 100
// Node.val is unique for each node.
// There are no repeated edges and no self-loops in the graph.
// The Graph is connected and all nodes can be visited starting from the given node.

//Code Structure:

/**
 * Definition for a Node.
 * class Node {
 *     public $val = null;
 *     public $neighbors = null;
 *     function __construct($val = 0) {
 *         $this->val = $val;
 *         $this->neighbors = array();
 *     }
 * }
 */

class Solution {
    /**
     * @param Node $node
     * @return Node
     */
    function cloneGraph($node) {
        if ($node === null) {
            return null; // Return null for an empty graph
        }

        $visited = []; // To keep track of visited nodes
        return $this->cloneNode($node, $visited);  
    }

    private function cloneNode($node, &$visited) {
        if (isset($visited[$node->val])) {
            return $visited[$node->val]; // Return the cloned node if it already exists
        }

        // Create a new cloned node
        $clonedNode = new Node($node->val);
        $visited[$node->val] = $clonedNode;

        // Recursively clone the neighbors
        foreach ($node->neighbors as $neighbor) {
            $clonedNode->neighbors[] = $this->cloneNode($neighbor, $visited);
        }

        return $clonedNode;
    }
}
    