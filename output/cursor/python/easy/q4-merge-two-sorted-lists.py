# https://leetcode.com/problems/merge-two-sorted-lists/
# Problem: Merge Two Sorted Lists

#Problem Description:
#You are given the heads of two sorted linked lists list1 and list2.
#Merge the two lists into one sorted list. The list should be made by splicing together the nodes of the first two lists.
#Return the head of the merged linked list.

# Constraints:
# The number of nodes in both lists is in the range [0, 50].
# -100 <= Node.val <= 100
#Both list1 and list2 are sorted in non-decreasing order.

#Code Structure:
# Definition for singly-linked list.
# class ListNode(object):
#     def __init__(self, val=0, next=None):
#         self.val = val
#         self.next = next
class Solution(object):
    def mergeTwoLists(self, list1, list2):
        """
        :type list1: Optional[ListNode]
        :type list2: Optional[ListNode]
        :rtype: Optional[ListNode]
        """
        # Create a dummy node to simplify the logic
        dummy = ListNode(0)
        current = dummy
        
        # Merge the lists while both have nodes
        while list1 and list2:
            if list1.val <= list2.val:
                current.next = list1
                list1 = list1.next
            else:
                current.next = list2
                list2 = list2.next
            current = current.next
        
        # Attach remaining nodes from either list
        if list1:
            current.next = list1
        if list2:
            current.next = list2
        
        return dummy.next
    