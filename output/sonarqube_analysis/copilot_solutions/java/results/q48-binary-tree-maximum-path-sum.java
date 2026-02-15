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
 * public class TreeNode {
 *     int val;
 *     TreeNode left;
 *     TreeNode right;
 *     TreeNode() {}
 *     TreeNode(int val) { this.val = val; }
 *     TreeNode(int val, TreeNode left, TreeNode right) {
 *         this.val = val;
 *         this.left = left;
 *         this.right = right;
 *     }
 * }
 */
class Solution {
    public int maxPathSum(TreeNode root) {
        if (root == null) {
            return 0; // If the tree is empty, return 0
        }
        
        int[] maxSum = new int[1]; // Use an array to keep track of the maximum path sum
        maxSum[0] = Integer.MIN_VALUE; // Initialize to the smallest possible value
        
        maxPathSumHelper(root, maxSum);
        
        return maxSum[0]; // Return the maximum path sum found
    }

    private int maxPathSumHelper(TreeNode node, int[] maxSum) {
        if (node == null) {
            return 0;
        }

        // Calculate the maximum path sum for the left and right subtrees
        int leftMax = Math.max(0, maxPathSumHelper(node.left, maxSum));
        int rightMax = Math.max(0, maxPathSumHelper(node.right, maxSum));

        // Update the maximum path sum found so far
        maxSum[0] = Math.max(maxSum[0], leftMax + rightMax + node.val);

        // Return the maximum path sum including the current node
        return Math.max(leftMax, rightMax) + node.val;
    }
}
    