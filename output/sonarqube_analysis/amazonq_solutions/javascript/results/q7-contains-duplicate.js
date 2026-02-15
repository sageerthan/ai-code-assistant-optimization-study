/** https://leetcode.com/problems/contains-duplicate */
// Problem: Contains Duplicate

//Problem Description:
//Given an integer array nums, return true if any value appears at least twice in the array, and return false if every element is distinct.

// Constraints:
// 1 <= nums.length <= 10^5
// -10^9 <= nums[i] <= 10^9

//Code Structure:
/**
 * @param {number[]} nums
 * @return {boolean}
 */
var containsDuplicate = function(nums) {
    // Create an empty object to store the numbers
    let obj = {};

    // Iterate through the array
    for (let i = 0; i < nums.length; i++) {
        // If the current number exists in the object, return true
        if (obj[nums[i]]) {
            return true;
        }

        // Otherwise, store the current number in the object
        obj[nums[i]] = true;
    }

    // If no duplicates were found, return false
    return false;
};
    