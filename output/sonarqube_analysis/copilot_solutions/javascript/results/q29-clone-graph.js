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
 * // Definition for a _Node.
 * function _Node(val, neighbors) {
 *    this.val = val === undefined ? 0 : val;
 *    this.neighbors = neighbors === undefined ? [] : neighbors;
 * };
 */

/**
 * @param {_Node} node
 * @return {_Node}
 */
var cloneGraph = function(node) {
    if (!node) return null; // If the input node is null, return null

    const visited = new Map(); // Map to keep track of visited nodes

    const dfs = (currentNode) => {
        if (visited.has(currentNode.val)) {
            return visited.get(currentNode.val); // Return the cloned node if already visited
        }

        // Create a new node with the same value
        const clonedNode = new _Node(currentNode.val);
        visited.set(currentNode.val, clonedNode); // Store the cloned node in the map

        // Recursively clone all neighbors
        for (const neighbor of currentNode.neighbors) {
            clonedNode.neighbors.push(dfs(neighbor));
        }

        return clonedNode; // Return the cloned node
    };

    return dfs(node); // Start DFS from the given node  
};
    