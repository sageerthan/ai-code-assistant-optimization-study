/** https://leetcode.com/problems/majority-element */
// Problem: Majority Element

//Problem Description:
//Given an array nums of size n, return the majority element.
//The majority element is the element that appears more than ⌊n / 2⌋ times. You may assume that the majority element always exists in the array.

// Constraints:
// n == nums.length
// 1 <= n <= 5 * 10^4
// -10^9 <= nums[i] <= 10^9

//Code Structure:
/**
 * @param {number[]} nums
 * @return {number}
 */
var majorityElement = function(nums) {
    // Create an empty object to store the count of each number
    let obj = {};

    // Iterate through the array
    for (let i = 0; i < nums.length; i++) {
        // If the number is already in the object, increment its count
        if (obj[nums[i]]) {
            obj[nums[i]]++;
        } else {
            // Otherwise, add the number to the object with a count of 1
            obj[nums[i]] = 1;
        }
    }

    // Iterate through the object
    for (let key in obj) {
        // If the count of the current number is greater than half the length of the array, return it
        if (obj[key] > nums.length / 2) {
            return parseInt(key);
        }
    }
};
    