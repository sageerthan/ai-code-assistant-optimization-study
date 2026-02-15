<?php
/** https://leetcode.com/problems/serialize-and-deserialize-binary-tree */
// Problem: Serialize and Deserialize Binary Tree

//Problem Description:
//Serialization is the process of converting a data structure or object into a sequence of bits so that it can be stored in a file or memory buffer, or transmitted across a network connection link to be reconstructed later in the same or another computer environment.
//Design an algorithm to serialize and deserialize a binary tree. There is no restriction on how your serialization/deserialization algorithm should work. You just need to ensure that a binary tree can be serialized to a string and this string can be deserialized to the original tree structure.
//Clarification: The input/output format is the same as how LeetCode serializes a binary tree. You do not necessarily need to follow this format, so please be creative and come up with different approaches yourself.

// Constraints:
// The number of nodes in the tree is in the range [0, 10^4].
// -1000 <= Node.val <= 1000

//Code Structure:
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
        
    }
  
    /**
     * @param TreeNode $root
     * @return String
     */
    function serialize($root) {
        $result = [];
        $this->serializeHelper($root, $result);
        return implode(',', $result);
    }
    
    private function serializeHelper($node, &$result) {
        if ($node === null) {
            $result[] = 'null';
            return;
        }
        
        $result[] = (string)$node->val;
        $this->serializeHelper($node->left, $result);
        $this->serializeHelper($node->right, $result);
    }
  
    /**
     * @param String $data
     * @return TreeNode
     */
    function deserialize($data) {
        $values = explode(',', $data);
        $index = 0;
        return $this->deserializeHelper($values, $index);
    }
    
    private function deserializeHelper($values, &$index) {
        if ($index >= count($values) || $values[$index] === 'null') {
            $index++;
            return null;
        }
        
        $node = new TreeNode((int)$values[$index]);
        $index++;
        $node->left = $this->deserializeHelper($values, $index);
        $node->right = $this->deserializeHelper($values, $index);
        
        return $node;
    }
}

/**
 * Your Codec object will be instantiated and called as such:
 * $ser = Codec();
 * $deser = Codec();
 * $data = $ser->serialize($root);
 * $ans = $deser->deserialize($data);
 */
    