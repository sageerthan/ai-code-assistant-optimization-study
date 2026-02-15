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
class Solution {
    public boolean isSymmetric(TreeNode root) {
        if (root == null) {
            return true;
        }
        return isSymmetricHelper(root.left, root.right);
    }
    
    private boolean isSymmetricHelper(TreeNode left, TreeNode right) {
        // Both nodes are null - symmetric
        if (left == null && right == null) {
            return true;
        }
        
        // One node is null, other is not - not symmetric
        if (left == null || right == null) {
            return false;
        }
        
        // Values don't match - not symmetric
        if (left.val != right.val) {
            return false;
        }
        
        // Recursively check if left.left matches right.right
        // and left.right matches right.left
        return isSymmetricHelper(left.left, right.right) && 
               isSymmetricHelper(left.right, right.left);
    }
}
    