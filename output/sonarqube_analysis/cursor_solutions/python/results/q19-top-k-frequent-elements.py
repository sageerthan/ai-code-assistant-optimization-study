# https://leetcode.com/problems/top-k-frequent-elements/
# Problem: Top K Frequent Elements

#Problem Description:
#Given an integer array nums and an integer k, return the k most frequent elements. You may return the answer in any order.

# Constraints:
# 1 <= nums.length <= 10^5
# -10^4 <= nums[i] <= 10^4
# k is in the range [1, the number of unique elements in the array].
# It is guaranteed that the answer is unique.

#Code Structure:
class Solution(object):
    def topKFrequent(self, nums, k):
        """
        :type nums: List[int]
        :type k: int
        :rtype: List[int]
        """
        from collections import Counter
        import heapq
        
        # Count frequency of each element
        count = Counter(nums)
        
        # Use a min heap to keep track of k most frequent elements
        heap = []
        
        for num, freq in count.items():
            heapq.heappush(heap, (freq, num))
            # Keep only k elements in the heap
            if len(heap) > k:
                heapq.heappop(heap)
        
        # Extract the elements from the heap
        result = [num for freq, num in heap]
        return result
    