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
        if ($root === null) {
            return [];
        }
        
        $result = [];
        $queue = [$root];
        
        while (!empty($queue)) {
            $levelSize = count($queue);
            $currentLevel = [];
            
            for ($i = 0; $i < $levelSize; $i++) {
                $node = array_shift($queue);
                $currentLevel[] = $node->val;
                
                if ($node->left !== null) {
                    $queue[] = $node->left;
                }
                if ($node->right !== null) {
                    $queue[] = $node->right;
                }
            }
            
            $result[] = $currentLevel;
        }
        
        return $result;
    }
}
    