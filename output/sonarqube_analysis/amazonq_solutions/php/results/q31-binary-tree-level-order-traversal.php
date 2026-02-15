<?php
/** https://leetcode.com/problems/binary-tree-level-order-traversal */
// Problem: Binary Tree Level Order Traversal

//Problem Description:
//Given the root of a binary tree, return the level order traversal of its nodes' values. (i.e., from left to right, level by level).

// Constraints:
// The number of nodes in the tree is in the range [0, 2000].
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
     * @return Integer[][]
     */
    function levelOrder($root) {
        $result = [];
        if ($root === null) {
            return $result;
        }
        $queue = new SplQueue();
        $queue->enqueue($root);
        while (!$queue->isEmpty()) {
            $levelSize = $queue->count();
            $level = [];
            for ($i = 0; $i < $levelSize; $i++) {
                $node = $queue->dequeue();
                $level[] = $node->val;
                if ($node->left !== null) {
                    $queue->enqueue($node->left);
                }
                if ($node->right !== null) {
                    $queue->enqueue($node->right);
                }
            }
            $result[] = $level;
        }
        return $result;
    }
}
    