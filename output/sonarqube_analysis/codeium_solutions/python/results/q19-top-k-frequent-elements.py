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
        count = {}
        for num in nums:
            if num not in count:
                count[num] = 1
            else:
                count[num] += 1

        sorted_count = sorted(count.items(), key=lambda x: x[1], reverse=True)

        return [x[0] for x in sorted_count[:k]]
    