/** https://leetcode.com/problems/binary-search */
// Problem: Binary Search

//Problem Description:
//Given an array of integers nums which is sorted in ascending order, and an integer target, write a function to search target in nums. If target exists, then return its index. Otherwise, return -1.
//You must write an algorithm with O(log n) runtime complexity.

// Constraints:
// 1 <= nums.length <= 10^4
// -10^4 < nums[i], target < 10^4
// All the integers in nums are unique.
// nums is sorted in ascending order.

//Code Structure:

/**
 * @param {number[]} nums
 * @param {number} target
 * @return {number}
 */
var search = function(nums, target) {
    let left = 0; // Initialize left pointer
    let right = nums.length - 1; // Initialize right pointer

    while (left <= right) {
        const mid = Math.floor((left + right) / 2); // Calculate mid index

        if (nums[mid] === target) {
            return mid; // Target found, return index
        } else if (nums[mid] < target) {
            left = mid + 1; // Move left pointer to the right
        } else {
            right = mid - 1; // Move right pointer to the left
        }
    }

    return -1; // Target not found, return -1  
};
    