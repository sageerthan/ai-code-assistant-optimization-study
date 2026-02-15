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
    if (!root) return 'null'; // Base case for null nodes

    // Pre-order traversal: root, left, right
    const leftSerialized = serialize(root.left);
    const rightSerialized = serialize(root.right);

    // Combine the current node value with serialized left and right subtrees
    return `${root.val},${leftSerialized},${rightSerialized}`;
    
};

/**
 * Decodes your encoded data to tree.
 * @param {string} data
 * @return {TreeNode}
 */
var deserialize = function(data) {
    const values = data.split(',').map(val => (val === 'null' ? null : parseInt(val)));
    let index = 0;

    const buildTree = () => {
        if (index >= values.length || values[index] === null) {
            index++;
            return null;
        }

        const node = new TreeNode(values[index++]);
        node.left = buildTree();
        node.right = buildTree();
        return node;
    };

    return buildTree();
};

/**
 * Your functions will be called as such:
 *
 * @param {string} data
 * @return {TreeNode}
 */
var deserialize = function(data) {
   const values = data.split(',').map(val => (val === 'null' ? null : parseInt(val)));
   let index = 0;

   const buildTree = () => {
       if (index >= values.length || values[index] === null) {
           index++;
           return null;
       }

       const node = new TreeNode(values[index++]);
       node.left = buildTree();
       node.right = buildTree();
       return node;
   };

   return buildTree();
};

/**
 * Your functions will be called as such:
 * deserialize(serialize(root));
 */
    