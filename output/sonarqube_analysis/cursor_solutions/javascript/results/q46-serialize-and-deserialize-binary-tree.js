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
 * function TreeNode(val) {
 *     this.val = val;
 *     this.left = this.right = null;
 * }
 */

/**
 * Encodes a tree to a single string.
 *
 * @param {TreeNode} root
 * @return {string}
 */
var serialize = function(root) {
    const result = [];
    serializeHelper(root, result);
    return result.join(',');
};

function serializeHelper(node, result) {
    if (node === null) {
        result.push('null');
        return;
    }
    
    result.push(node.val.toString());
    serializeHelper(node.left, result);
    serializeHelper(node.right, result);
}

/**
 * Decodes your encoded data to tree.
 *
 * @param {string} data
 * @return {TreeNode}
 */
var deserialize = function(data) {
    const values = data.split(',');
    let index = 0;
    
    return deserializeHelper(values);
    
    function deserializeHelper(values) {
        if (index >= values.length || values[index] === 'null') {
            index++;
            return null;
        }
        
        const node = new TreeNode(parseInt(values[index]));
        index++;
        node.left = deserializeHelper(values);
        node.right = deserializeHelper(values);
        
        return node;
    }
};

/**
 * Your functions will be called as such:
 * deserialize(serialize(root));
 */
    