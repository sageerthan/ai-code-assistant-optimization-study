/** https://leetcode.com/problems/binary-tree-level-order-traversal */
// Problem: Binary Tree Level Order Traversal

//Problem Description:
//Given the root of a binary tree, return the level order traversal of its nodes' values. (i.e., from left to right, level by level).

// Constraints:
// The number of nodes in the tree is in the range [0, 2000].
// -1000 <= Node.val <= 1000

//Code Structure:
/**
 * Definition for a binary tree node.
 * function TreeNode(val, left, right) {
 *     this.val = (val===undefined ? 0 : val)
 *     this.left = (left===undefined ? null : left)
 *     this.right = (right===undefined ? null : right)
 * }
 */
/**
 * @param {TreeNode} root
 * @return {number[][]}
 */
var levelOrder = function(root) {
    if (!root) return []; // If the tree is empty, return an empty array

    const result = []; // Array to hold the level order traversal
    const queue = [root]; // Queue to hold nodes for BFS

    while (queue.length > 0) {
        const levelSize = queue.length; // Number of nodes at the current level
        const currentLevel = []; // Array to hold values of the current level

        for (let i = 0; i < levelSize; i++) {
            const node = queue.shift(); // Dequeue the front node
            currentLevel.push(node.val); // Add its value to the current level

            // Enqueue left and right children if they exist
            if (node.left) queue.push(node.left);
            if (node.right) queue.push(node.right);
        }

        result.push(currentLevel); // Add the current level to the result
    }

    return result; // Return the final result   
};
    