# https://leetcode.com/problems/top-k-frequent-elements/
# Problem: Top K Frequent Elements

#Problem Description:
#Given an integer array nums and an integer k, return the k most frequent elements. You may return the answer in any order.

# Constraints:
# 1 <= nums.length <= 105
# -104 <= nums[i] <= 104
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
        
        # Count the frequency of each element
        count = Counter(nums)
        
        # Use a heap to find the k most common elements
        return [item[0] for item in heapq.nlargest(k, count.items(), key=lambda x: x[1])]                                                                       
    