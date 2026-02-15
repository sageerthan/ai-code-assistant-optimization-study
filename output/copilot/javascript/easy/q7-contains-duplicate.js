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
    const seen = new Set(); // Create a set to track seen numbers

    for (const num of nums) {
        if (seen.has(num)) {
            return true; // If the number is already in the set, return true
        }
        seen.add(num); // Add the number to the set
    }

    return false; // If no duplicates found, return false
    
};
    