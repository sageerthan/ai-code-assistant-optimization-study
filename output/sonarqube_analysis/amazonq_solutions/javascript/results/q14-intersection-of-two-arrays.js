/** https://leetcode.com/problems/intersection-of-two-arrays */
// Problem: Intersection of Two Arrays

//Problem Description:
//Given two integer arrays nums1 and nums2, return an array of their intersection. Each element in the result must be unique and you may return the result in any order.

// Constraints:
// 1 <= nums1.length, nums2.length <= 1000
// 0 <= nums1[i], nums2[i] <= 1000

//Code Structure:
/**
 * @param {number[]} nums1
 * @param {number[]} nums2
 * @return {number[]}
 */
var intersection = function(nums1, nums2) {
    // Create an empty array to store the intersection
    let intersection = [];

    // Iterate through the first array
    for (let i = 0; i < nums1.length; i++) {
        // Check if the current element is in the second array and not already in the intersection
        if (nums2.includes(nums1[i]) && !intersection.includes(nums1[i])) {
            // If so, add it to the intersection
            intersection.push(nums1[i]);
        }
    }

    // Return the intersection
    return intersection;
};
    