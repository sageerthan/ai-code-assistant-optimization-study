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

    /**
     * @param TreeNode $root
     * @return Integer
     */
    function maxPathSum($root) {
        $maxSum = PHP_INT_MIN;
        $this->maxGain($root, $maxSum);
        return $maxSum;
    }

    private function maxGain($node, &$maxSum) {
        if ($node === null) return 0;

        // Calculate the maximum path sum "starting" from the left and right child
        $leftGain = max($this->maxGain($node->left, $maxSum), 0);
        $rightGain = max($this->maxGain($node->right, $maxSum), 0);

        // Update the maximum path sum
        $maxSum = max($maxSum, $node->val + $leftGain + $rightGain);

        // Return the maximum gain if we continue the same path
        return $node->val + max($leftGain, $rightGain);
    }
}
    