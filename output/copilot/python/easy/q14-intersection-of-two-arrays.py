# https://leetcode.com/problems/intersection-of-two-arrays/
# Problem: Intersection of Two Arrays

#Problem Description:
#Given two integer arrays nums1 and nums2, return an array of their intersection. Each element in the result must be unique and you may return the result in any order.

# # Constraints:
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
        set1 = set(nums1)
        set2 = set(nums2)
        intersection = set1.intersection(set2)
        return list(intersection)                                                      
    