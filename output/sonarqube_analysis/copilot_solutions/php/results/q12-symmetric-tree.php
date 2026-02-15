<?php
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
     * @return Boolean
     */
    function isSymmetric($root) {
        if ($root === null) {
            return true; // An empty tree is symmetric
        }

        // Helper function to check symmetry
        function isMirror($left, $right) {
            if ($left === null && $right === null) {
                return true; // Both nodes are null, symmetric
            }
            if ($left === null || $right === null) {
                return false; // One node is null, not symmetric
            }
            return ($left->val === $right->val) &&
                   isMirror($left->left, $right->right) &&
                   isMirror($left->right, $right->left);
        }

        return isMirror($root->left, $root->right); // Start checking from the root's children   
    }
}
    