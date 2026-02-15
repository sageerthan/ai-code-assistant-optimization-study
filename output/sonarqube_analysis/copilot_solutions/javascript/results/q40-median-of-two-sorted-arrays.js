/** https://leetcode.com/problems/median-of-two-sorted-arrays */
// Problem: Median of Two Sorted Arrays

//Problem Description:
//Given two sorted arrays nums1 and nums2 of size m and n respectively, return the median of the two sorted arrays.
//The overall run time complexity should be O(log (m+n)).

// Constraints:
// nums1.length == m
// nums2.length == n
// 0 <= m <= 1000
// 0 <= n <= 1000
// 1 <= m + n <= 2000
// -10^6 <= nums1[i], nums2[i] <= 10^6

//Code Structure:
/**
 * @param {number[]} nums1
 * @param {number[]} nums2
 * @return {number}
 */
var findMedianSortedArrays = function(nums1, nums2) {
    const merged = [...nums1, ...nums2].sort((a, b) => a - b); // Merge and sort the arrays
    const len = merged.length; // Get the length of the merged array

    if (len % 2 === 0) { // If the length is even
        return (merged[len / 2 - 1] + merged[len / 2]) / 2; // Return the average of the two middle elements
    } else { // If the length is odd
        return merged[Math.floor(len / 2)]; // Return the middle element
    }
    
};
    