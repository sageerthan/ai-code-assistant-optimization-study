# https://leetcode.com/problems/median-of-two-sorted-arrays/
# Problem: Median of Two Sorted Arrays

#Problem Description:
#Given two sorted arrays nums1 and nums2 of size m and n respectively, return the median of the two sorted arrays.
#The overall run time complexity should be O(log (m+n)).

# Constraints:
# nums1.length == m
# nums2.length == n
# 0 <= m <= 1000
# 0 <= n <= 1000
# 1 <= m + n <= 2000
# -10^6 <= nums1[i], nums2[i] <= 10^6

#Code Structure:

# First generated code:

class Solution(object):
    def findMedianSortedArrays(self, nums1, nums2):
        """
        :type nums1: List[int]
        :type nums2: List[int]
        :rtype: float
        """
        merged = sorted(nums1 + nums2)
        length = len(merged)
        if length % 2 == 0:
            return (merged[length // 2 - 1] + merged[length // 2]) / 2
        else:
            return merged[length // 2]
        
# Debugged Code

class Solution:
    def findMedianSortedArrays(self, nums1, nums2):
        m, n = len(nums1), len(nums2)
        if (m + n) % 2 == 1:
            return self.getKth(nums1, 0, nums2, 0, (m + n) // 2 + 1) / 1.0
        else:
            return (self.getKth(nums1, 0, nums2, 0, (m + n) // 2) + self.getKth(nums1, 0, nums2, 0, (m + n) // 2 + 1)) / 2.0

    def getKth(self, nums1, p, nums2, q, k):
        if p > q:
            return self.getKth(nums2, q, nums1, p, k)
        if q - p == 0:
            return nums1[p]
        if k == 1:
            return min(nums1[p], nums2[q])

        pa = min(p + (k // 2) - 1, p + (k // 2) + (q - p) - 1)
        pb = min(q + (k // 2) - 1, p + (k // 2) + (q - p) - 1)

        if nums1[pa] > nums2[pb]:
            return self.getKth(nums1, p, nums2, pb - (pb - pa), k - (pb - pa))
        else:
            return self.getKth(nums1, pa + (pa - p), nums2, q, k - (pa - p))
    