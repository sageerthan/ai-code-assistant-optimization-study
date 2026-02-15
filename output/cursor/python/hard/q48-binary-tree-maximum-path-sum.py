# https://leetcode.com/problems/binary-tree-maximum-path-sum/
# Problem: Binary Tree Maximum Path Sum

#Problem Description:
#A path in a binary tree is a sequence of nodes where each pair of adjacent nodes in the sequence has an edge connecting them. A node can only appear in the sequence at most once. Note that the path does not need to pass through the root.
#The path sum of a path is the sum of the node's values in the path.
#Given the root of a binary tree, return the maximum path sum of any non-empty path.

# Constraints:
# The number of nodes in the tree is in the range [1, 3 * 10^4].
# -1000 <= Node.val <= 1000

#Code Structure:

# Definition for a binary tree node.
# class TreeNode(object):
#     def __init__(self, val=0, left=None, right=None):
#         self.val = val
#         self.left = left
#         self.right = right
class Solution(object):
    def maxPathSum(self, root):
        """
        :type root: Optional[TreeNode]
        :rtype: int
        """
        self.max_sum = float('-inf')
        
        def max_gain(node):
            if not node:
                return 0
            
            # Recursively get the max gain from left and right subtrees
            left_gain = max(max_gain(node.left), 0)
            right_gain = max(max_gain(node.right), 0)
            
            # The price to start a new path where 'node' is the highest node
            price_newpath = node.val + left_gain + right_gain
            
            # Update the global maximum
            self.max_sum = max(self.max_sum, price_newpath)
            
            # Return the maximum gain if we continue the same path
            return node.val + max(left_gain, right_gain)
        
        max_gain(root)
        return self.max_sum
    