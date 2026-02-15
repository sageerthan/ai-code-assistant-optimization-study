/** https://leetcode.com/problems/two-sum */
// Problem: Two Sum

//Problem Description:
// Given an array of integers nums and an integer target, return indices of the two numbers such that they add up to target.
// You may assume that each input would have exactly one solution, and you may not use the same element twice.
// You can return the answer in any order.

// Constraints:
// 2 <= nums.length <= 10^4
// -10^9 <= nums[i] <= 10^9
// -10^9 <= target <= 10^9
// Only one valid answer exists.

//Code Structure:

/**
 * @param {number[]} nums
 * @param {number} target
 * @return {number[]}
 */
var twoSum = function(nums, target) {
    // Create an empty object to store the complement of each number
    let obj = {};

    // Iterate through the array
    for (let i = 0; i < nums.length; i++) {
        // Calculate the complement of the current number
        let complement = target - nums[i];

        // Check if the complement exists in the object
        if (obj[complement] !== undefined) {
            // If it does, return the indices of the current number and its complement
            return [obj[complement], i];
        }

        // Otherwise, store the current number and its index in the object
        obj[nums[i]] = i;
    }
    // If no two numbers add up to the target, return an empty array
    return [];
};
    