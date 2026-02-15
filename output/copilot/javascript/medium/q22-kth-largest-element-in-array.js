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

// First generated code:

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
   


// Debugged Code:

/**
 * @param {number[]} nums
 * @param {number} k
 * @return {number}
 */
var findKthLargest = function(nums, k) {
    // Quickselect approach: find the element with index nums.length - k
    const target = nums.length - k;

    function swap(i, j) {
        const t = nums[i]; nums[i] = nums[j]; nums[j] = t;
    }

    function partition(left, right, pivotIndex) {
        const pivot = nums[pivotIndex];
        swap(pivotIndex, right);
        let store = left;
        for (let i = left; i < right; i++) {
            if (nums[i] < pivot) {
                swap(store, i);
                store++;
            }
        }
        swap(store, right);
        return store;
    }

    function quickSelect(left, right) {
        if (left === right) return nums[left];
        const pivotIndex = left + Math.floor(Math.random() * (right - left + 1));
        const pivotNewIndex = partition(left, right, pivotIndex);
        if (pivotNewIndex === target) {
            return nums[pivotNewIndex];
        } else if (pivotNewIndex < target) {
            return quickSelect(pivotNewIndex + 1, right);
        } else {
            return quickSelect(left, pivotNewIndex - 1);
        }
    }

    return quickSelect(0, nums.length - 1);
};
    