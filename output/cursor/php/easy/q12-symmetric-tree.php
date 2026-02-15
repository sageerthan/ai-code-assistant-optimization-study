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
            return true;
        }
        
        return $this->isMirror($root->left, $root->right);
    }
    
    private function isMirror($left, $right) {
        // Both null - symmetric
        if ($left === null && $right === null) {
            return true;
        }
        
        // One null, one not - not symmetric
        if ($left === null || $right === null) {
            return false;
        }
        
        // Values must be equal and subtrees must be mirrors
        return ($left->val === $right->val) &&
               $this->isMirror($left->left, $right->right) &&
               $this->isMirror($left->right, $right->left);
    }
}
    