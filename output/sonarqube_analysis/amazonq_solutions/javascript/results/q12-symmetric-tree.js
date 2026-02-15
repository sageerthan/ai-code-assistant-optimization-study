/** https://leetcode.com/problems/symmetric-tree */
// Problem: Symmetric Tree

//Problem Description:
//Given the root of a binary tree, check whether it is a mirror of itself (i.e., symmetric around its center).

// Constraints:
// The number of nodes in the tree is in the range [1, 1000].
// -100 <= Node.val <= 100

//Code Structure:


/**
 * Definition for a binary tree node.
 * function TreeNode(val, left, right) {
 *     this.val = (val===undefined ? 0 : val)
 *     this.left = (left===undefined ? null : left)
 *     this.right = (right===undefined ? null : right)
 * }
 */
/**
 * @param {TreeNode} root
 * @return {boolean}
 */
var isSymmetric = function(root) {
    if (!root) return true;
    
    function isMirror(left, right) {
        if (!left && !right) return true;
        if (!left || !right || left.val !== right.val) return false;
        
        return isMirror(left.left, right.right) && isMirror(left.right, right.left);
    }
    
    return isMirror(root.left, root.right);
};
    