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
    return quickSelect(nums, 0, nums.length - 1, nums.length - k);
};

function quickSelect(nums, left, right, k) {
    if (left === right) {
        return nums[left];
    }
    
    const pivotIndex = partition(nums, left, right);
    
    if (k === pivotIndex) {
        return nums[k];
    } else if (k < pivotIndex) {
        return quickSelect(nums, left, pivotIndex - 1, k);
    } else {
        return quickSelect(nums, pivotIndex + 1, right, k);
    }
}

function partition(nums, left, right) {
    const pivot = nums[right];
    let i = left;
    
    for (let j = left; j < right; j++) {
        if (nums[j] <= pivot) {
            [nums[i], nums[j]] = [nums[j], nums[i]];
            i++;
        }
    }
    
    [nums[i], nums[right]] = [nums[right], nums[i]];
    return i;
}
    