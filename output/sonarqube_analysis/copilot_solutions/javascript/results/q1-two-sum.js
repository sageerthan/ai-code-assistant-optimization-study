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
    const numMap = new Map(); // Create a map to store the indices of the numbers

    for (let i = 0; i < nums.length; i++) {
        const complement = target - nums[i]; // Calculate the complement of the current number

        if (numMap.has(complement)) {
            // If the complement exists in the map, return the indices
            return [numMap.get(complement), i];
        }

        // Store the index of the current number in the map
        numMap.set(nums[i], i);
    }

    return []; // Return an empty array if no solution is found
    
};
    