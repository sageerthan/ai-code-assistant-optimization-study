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
    // Initialize left and right pointers
    let left = 0;
    let right = nums.length - 1;

    // Perform binary search
    while (left <= right) {
        // Calculate the middle index
        let mid = Math.floor((left + right) / 2);

        // If the target is found, return its index
        if (nums[mid] === target) {
            return mid;
        }
        // If the target is smaller than the middle element, search the left half
        else if (nums[mid] > target) {
            right = mid - 1;
        }
        // If the target is larger than the middle element, search the right half
        else {
            left = mid + 1;
        }
    }

    // If the target is not found, return -1
    return -1;
};
    