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
        if ($root == null) {
            return null;
        }

        $temp = $root->left;
        $root->left = $root->right;
        $root->right = $temp;

        $this->invertTree($root->left);
        $this->invertTree($root->right);

        return $root;
    }
}
    