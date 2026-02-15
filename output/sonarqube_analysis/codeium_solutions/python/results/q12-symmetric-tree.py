# https://leetcode.com/problems/symmetric-tree/
# Problem: Symmetric Tree

#Problem Description:
#Given the root of a binary tree, check whether it is a mirror of itself (i.e., symmetric around its center).

# Constraints:
# The number of nodes in the tree is in the range [1, 1000].
# -100 <= Node.val <= 100

#Code Structure:


# Definition for a binary tree node.
# class TreeNode(object):
#     def __init__(self, val=0, left=None, right=None):
#         self.val = val
#         self.left = left
#         self.right = right
class Solution(object):
    def isSymmetric(self, root):
        """
        :type root: Optional[TreeNode]
        :rtype: bool
        """
        if not root:
            return True
        
        return self.isMirror(root.left, root.right)
    
    def isMirror(self, left, right):
        if not left and not right:
            return True
        if not left or not right:
            return False
        
        return self.isMirror(left.left, right.right) and self.isMirror(left.right, right.left)
    