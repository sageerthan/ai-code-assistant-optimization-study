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

// Debugged Code:

/**
 * @param {number[]} nums
 * @param {number} k
 * @return {number}
 */
var findKthLargest = function(nums, k) {
    // Use a size-k min-heap to keep the k largest elements seen so far.
    const heap = [];

    const swap = (i, j) => {
        const tmp = heap[i];
        heap[i] = heap[j];
        heap[j] = tmp;
    };

    const siftUp = (idx) => {
        while (idx > 0) {
            const parent = Math.floor((idx - 1) / 2);
            if (heap[parent] <= heap[idx]) break;
            swap(parent, idx);
            idx = parent;
        }
    };

    const siftDown = (idx) => {
        const n = heap.length;
        while (true) {
            let smallest = idx;
            const left = idx * 2 + 1;
            const right = idx * 2 + 2;

            if (left < n && heap[left] < heap[smallest]) smallest = left;
            if (right < n && heap[right] < heap[smallest]) smallest = right;

            if (smallest === idx) break;
            swap(idx, smallest);
            idx = smallest;
        }
    };

    for (const num of nums) {
        if (heap.length < k) {
            heap.push(num);
            siftUp(heap.length - 1);
        } else if (num > heap[0]) {
            heap[0] = num;
            siftDown(0);
        }
    }

    return heap[0];
};