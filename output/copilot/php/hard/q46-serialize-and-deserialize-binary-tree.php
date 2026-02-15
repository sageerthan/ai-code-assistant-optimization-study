<?php
/** https://leetcode.com/problems/serialize-and-deserialize-binary-tree */
// Problem: Serialize and Deserialize Binary Tree

// Problem Description:
// Serialization is the process of converting a data structure or object into a sequence of bits so that it can be stored in a file or memory buffer, or transmitted across a network connection link to be reconstructed later in the same or another computer environment.
// Design an algorithm to serialize and deserialize a binary tree. There is no restriction on how your serialization/deserialization algorithm should work. You just need to ensure that a binary tree can be serialized to a string and this string can be deserialized to the original tree structure.
// Clarification: The input/output format is the same as how LeetCode serializes a binary tree. You do not necessarily need to follow this format, so please be creative and come up with different approaches yourself.

// Constraints:
// The number of nodes in the tree is in the range [0, 10^4].
// -1000 <= Node.val <= 1000

// Code Structure:
/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($value) { $this->val = $value; }
 * }
 */

class Codec {
    function __construct() {   
        // No initialization needed
    }
  
    /**
     * Serializes a binary tree to a single string using level-order traversal (BFS).
     * @param TreeNode $root
     * @return String
     */
    function serialize($root) {
        if ($root === null) return '';
        $queue = [$root];
        $result = [];
        while (!empty($queue)) {
            $node = array_shift($queue);
            if ($node === null) {
                $result[] = 'null';
            } else {
                $result[] = $node->val;
                $queue[] = $node->left;
                $queue[] = $node->right;
            }
        }
        // Remove trailing 'null's for compactness
        while (end($result) === 'null') {
            array_pop($result);
        }
        return implode(',', $result);
    }
  
    /**
     * Deserializes your encoded data to tree.
     * @param String $data
     * @return TreeNode
     */
    function deserialize($data) {
        if (empty($data)) return null;
        $nodes = explode(',', $data);
        $root = new TreeNode(intval($nodes[0]));
        $queue = [$root];
        $i = 1;
        while (!empty($queue)) {
            $current = array_shift($queue);
            if ($i < count($nodes)) {
                $leftVal = $nodes[$i++];
                if ($leftVal !== 'null') {
                    $current->left = new TreeNode(intval($leftVal));
                    $queue[] = $current->left;
                }
            }
            if ($i < count($nodes)) {
                $rightVal = $nodes[$i++];
                if ($rightVal !== 'null') {
                    $current->right = new TreeNode(intval($rightVal));
                    $queue[] = $current->right;
                }
            }
        }
        return $root;
    }
}

/**
 * Your Codec object will be instantiated and called as such:
 * $ser = Codec();
 * $deser = Codec();
 * $data = $ser->serialize($root);
 * $ans = $deser->deserialize($data);
*/