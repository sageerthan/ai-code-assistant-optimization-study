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
        """
        Helper function to check if two subtrees are mirrors of each other
        """
        # Both are None
        if not left and not right:
            return True
        
        # One is None, the other is not
        if not left or not right:
            return False
        
        # Values must be equal and subtrees must be mirrors
        return (left.val == right.val and 
                self.isMirror(left.left, right.right) and 
                self.isMirror(left.right, right.left))
    