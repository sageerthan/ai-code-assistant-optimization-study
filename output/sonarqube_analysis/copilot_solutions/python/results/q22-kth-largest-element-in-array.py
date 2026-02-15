# https://leetcode.com/problems/kth-largest-element-in-array/
# Problem: Kth Largest Element in an Array

#Problem Description:
#Given an integer array nums and an integer k, return the kth largest element in the array.
#Note that it is the kth largest element in the sorted order, not the kth distinct element.
#Can you solve it without sorting?

# Constraints:
# 1 <= k <= nums.length <= 10^5
# -10^4 <= nums[i] <= 10^4

#Code Structure:

class Solution(object):
    def findKthLargest(self, nums, k):
        """
        :type nums: List[int]
        :type k: int
        :rtype: int
        """ 
        import heapq
        
        # Use a min-heap to keep track of the k largest elements
        min_heap = []
        
        for num in nums:
            heapq.heappush(min_heap, num)
            if len(min_heap) > k:
                heapq.heappop(min_heap)
        
        # The root of the min-heap is the kth largest element
        return min_heap[0]                                                                         
    