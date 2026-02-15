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
    if (!root) return 'X';
    return root.val + ',' + serialize(root.left) + ',' + serialize(root.right);
};

/**
 * Decodes your encoded data to tree.
 *
 * @param {string} data
 * @return {TreeNode}
 */
var deserialize = function(data) {
    let nodes = data.split(',');
    function helper() {
        let node = nodes.shift();
        if (node === 'X') return null;
        let curr = new TreeNode(node);
        curr.left = helper();
        curr.right = helper();
        return curr;
    }
    return helper();
};

/**
 * Your functions will be called as such:
 * deserialize(serialize(root));
 */
    