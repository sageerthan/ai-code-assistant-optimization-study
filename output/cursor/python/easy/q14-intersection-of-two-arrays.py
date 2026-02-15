# https://leetcode.com/problems/intersection-of-two-arrays/
# Problem: Intersection of Two Arrays

#Problem Description:
#Given two integer arrays nums1 and nums2, return an array of their intersection. Each element in the result must be unique and you may return the result in any order.

# Constraints:
# 1 <= nums1.length, nums2.length <= 1000
# 0 <= nums1[i], nums2[i] <= 1000

#Code Structure:
class Solution(object):
    def intersection(self, nums1, nums2):
        """
        :type nums1: List[int]
        :type nums2: List[int]
        :rtype: List[int]
        """
        # Convert nums1 to a set for O(1) lookup
        set1 = set(nums1)
        result = []
        
        # Check each element in nums2
        for num in nums2:
            if num in set1:
                result.append(num)
                # Remove from set to avoid duplicates
                set1.remove(num)
        
        return result
    