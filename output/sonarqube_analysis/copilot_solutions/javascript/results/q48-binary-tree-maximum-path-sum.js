/** https://leetcode.com/problems/binary-tree-maximum-path-sum */
// Problem: Binary Tree Maximum Path Sum

//Problem Description:
//A path in a binary tree is a sequence of nodes where each pair of adjacent nodes in the sequence has an edge connecting them. A node can only appear in the sequence at most once. Note that the path does not need to pass through the root.
//The path sum of a path is the sum of the node's values in the path.
//Given the root of a binary tree, return the maximum path sum of any non-empty path.

// Constraints:
// The number of nodes in the tree is in the range [1, 3 * 104].
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
 * @return {number}
 */
var maxPathSum = function(root) {
    let maxSum = -Infinity;

    const findMaxPath = (node) => {
        if (!node) return 0;

        // Calculate max path sum for left and right subtrees
        const leftMax = Math.max(findMaxPath(node.left), 0);
        const rightMax = Math.max(findMaxPath(node.right), 0);

        // Update the global maxSum
        maxSum = Math.max(maxSum, leftMax + rightMax + node.val);

        // Return the maximum path sum extending from the current node
        return Math.max(leftMax, rightMax) + node.val;
    };

    findMaxPath(root);
    return maxSum;
};
    