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
    private $null = 'X';
    private $delimiter = ',';
    
    function __construct() {
        
    }
  
    /**
     * @param TreeNode $root
     * @return String
     */
    function serialize($root) {
        if (!$root) {
            return $this->null;
        }
        $serialized = $root->val;
        $serialized .= $this->delimiter . $this->serialize($root->left);
        $serialized .= $this->delimiter . $this->serialize($root->right);
        return $serialized;
    }
  
    /**
     * @param String $data
     * @return TreeNode
     */
    function deserialize($data) {
        $data = explode($this->delimiter, $data);
        return $this->deserializeHelper($data);
    }
    
    private function deserializeHelper(&$data) {
        $val = array_shift($data);
        if ($val == $this->null) {
            return null;
        }
        $node = new TreeNode($val);
        $node->left = $this->deserializeHelper($data);
        $node->right = $this->deserializeHelper($data);
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
    