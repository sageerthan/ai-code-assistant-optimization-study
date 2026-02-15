/** https://leetcode.com/problems/invert-binary-tree */
// Problem: Invert Binary Tree

//Problem Description:
//Given the root of a binary tree, invert the tree, and return its root.

// Constraints:
// The number of nodes in the tree is in the range [0, 100].
// -100 <= Node.val <= 100

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
    public TreeNode invertTree(TreeNode root) {
        // Base case: if root is null, return null
        if (root == null) {
            return null;
        }
        
        // Recursively invert left and right subtrees
        TreeNode left = invertTree(root.left);
        TreeNode right = invertTree(root.right);
        
        // Swap the left and right children
        root.left = right;
        root.right = left;
        
        return root;
    }
}
    