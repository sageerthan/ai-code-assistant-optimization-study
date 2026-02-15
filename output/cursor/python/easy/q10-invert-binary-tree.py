# https://leetcode.com/problems/invert-binary-tree/
# Problem: Invert Binary Tree

#Problem Description:
#Given the root of a binary tree, invert the tree, and return its root.

# Constraints:
# The number of nodes in the tree is in the range [0, 100].
# -100 <= Node.val <= 100

#Code Structure:

# Definition for a binary tree node.
# class TreeNode(object):
#     def __init__(self, val=0, left=None, right=None):
#         self.val = val
#         self.left = left
#         self.right = right
class Solution(object):
    def invertTree(self, root):
        """
        :type root: Optional[TreeNode]
        :rtype: Optional[TreeNode]
        """
        # Base case: if root is None, return None
        if not root:
            return None
        
        # Recursively invert left and right subtrees
        left_inverted = self.invertTree(root.left)
        right_inverted = self.invertTree(root.right)
        
        # Swap the left and right children
        root.left = right_inverted
        root.right = left_inverted
        
        return root
    