<?php
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

    private $maxSum = -1000;
    
    /**
     * @param TreeNode $root
     * @return Integer
     */
    function maxPathSum($root) {
        $this->maxSum = -1000;
        $this->maxGain($root);
        return $this->maxSum;
    }
    
    private function maxGain($node) {
        if (!$node) {
            return 0;
        }
        $leftGain = max($this->maxGain($node->left), 0);
        $rightGain = max($this->maxGain($node->right), 0);
        
        $priceNewpath = $node->val + $leftGain + $rightGain;
        
        $this->maxSum = max($this->maxSum, $priceNewpath);
        
        return $node->val + max($leftGain, $rightGain);
    }
}
    