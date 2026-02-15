/** https://leetcode.com/problems/kth-largest-element-in-an-array */
// Problem: Kth Largest Element in an Array

//Problem Description:
//Given an integer array nums and an integer k, return the kth largest element in the array.
//Note that it is the kth largest element in the sorted order, not the kth distinct element.
//Can you solve it without sorting?

// Constraints:
// 1 <= k <= nums.length <= 10^5
// -10^4 <= nums[i] <= 10^4

//Code Structure:

/**
 * @param {number[]} nums
 * @param {number} k
 * @return {number}
 */
var findKthLargest = function(nums, k) {
    // Create a max heap using the first k elements
    const maxHeap = new maxHeap(nums.slice(0, k));

    // Iterate through the rest of the elements
    for (let i = k; i < nums.length; i++) {
        if (nums[i] > maxHeap.peek()) {
            maxHeap.replace(nums[i]);
        }
    }

    // The root of the max heap is the kth largest element
    return maxHeap.peek(); 
};
    