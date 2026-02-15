<?php
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
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($val = 0, $left = null, $right = null) {
 *         $this->val = $val;
 *         $this->left = $left;
 *         $this->right = $right;
 *     }
 * }
 */
class Solution {

    /**
     * @param TreeNode $root
     * @return TreeNode
     */
    function invertTree($root) {
        // Base case: if root is null, return null
        if ($root === null) {
            return null;
        }
        
        // Recursively invert left and right subtrees
        $left = $this->invertTree($root->left);
        $right = $this->invertTree($root->right);
        
        // Swap the left and right children
        $root->left = $right;
        $root->right = $left;
        
        return $root;
    }
}
    