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

// First generated code

/**
 * @param {number[]} nums
 * @param {number} k
 * @return {number}
 */
var findKthLargest = function(nums, k) {
    const heap = new Heap((a, b) => a < b);
    for (const num of nums) {
        heap.add(num);
    }

    for (let i = 0; i < k - 1; i++) {
        heap.poll();
    }

    return heap.poll();
};

// Debugged Code

var Heap = require('./heap');

/**
 * @param {number[]} nums
 * @param {number} k
 * @return {number}
 */
var findKthLargest = function(nums, k) {
    const heap = new Heap((a, b) => a < b);
    for (const num of nums) {
        heap.push(num);
    }

    for (let i = 0; i < k - 1; i++) {
        heap.pop();
    }

    return heap.peek();
};
    