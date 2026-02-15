/** https://leetcode.com/problems/symmetric-tree */
// Problem: Symmetric Tree

//Problem Description:
//Given the root of a binary tree, check whether it is a mirror of itself (i.e., symmetric around its center).

// Constraints:
// The number of nodes in the tree is in the range [1, 1000].
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

// First generated code:

class Solution {
    public boolean isSymmetric(TreeNode root) {
        if (root == null) {
            return true; // An empty tree is symmetric
        }
        return isMirror(root.left, root.right); // Check if left and right subtrees are mirrors of each other
        
    }
}

// Debugged Code:

class Solution {
    public boolean isSymmetric(TreeNode root) {
        if (root == null) {
            return true; // An empty tree is symmetric
        }
        return isMirror(root.left, root.right); // Check if left and right subtrees are mirrors of each other
    }
    
    private boolean isMirror(TreeNode left, TreeNode right) {
        // Both nodes are null - they are mirrors
        if (left == null && right == null) {
            return true;
        }
        // One is null and the other is not - not mirrors
        if (left == null || right == null) {
            return false;
        }
        // Check if values are equal and subtrees are mirrors
        return left.val == right.val && 
               isMirror(left.left, right.right) && 
               isMirror(left.right, right.left);
    }
}
    