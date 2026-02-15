# https://leetcode.com/problems/merge-k-sorted-lists/
# Problem: Merge K Sorted Lists

#Problem Description:
#You are given an array of k linked-lists lists, each linked-list is sorted in ascending order.
#Merge all the linked-lists into one sorted linked-list and return it.

# Constraints:
# k == lists.length
# 0 <= k <= 10^4
# 0 <= lists[i].length <= 500
# -10^4 <= lists[i][j] <= 10^4
# lists[i] is sorted in ascending order.
# The sum of lists[i].length will not exceed 10^4.


#Code Structure:

# Definition for singly-linked list.
# class ListNode(object):
#     def __init__(self, val=0, next=None):
#         self.val = val
#         self.next = next
class Solution(object):
    def mergeKLists(self, lists):
        """
        :type lists: List[Optional[ListNode]]
        :rtype: Optional[ListNode]
        """
        import heapq
        
        min_heap = []
        
        # Initialize the heap with the head of each list
        for i, l in enumerate(lists):
            if l:
                heapq.heappush(min_heap, (l.val, i, l))
        
        dummy = ListNode(0)
        current = dummy
        
        while min_heap:
            val, i, node = heapq.heappop(min_heap)
            current.next = ListNode(val)
            current = current.next
            
            # If there is a next node in the same list, push it to the heap
            if node.next:
                heapq.heappush(min_heap, (node.next.val, i, node.next))
        
        return dummy.next                           
    