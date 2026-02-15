/** https://leetcode.com/problems/missing-number */
// Problem: Missing Number

//Problem Description:
//Given an array nums containing n distinct numbers in the range [0, n], return the only number in the range that is missing from the array.

// Constraints:
// n == nums.length
// 1 <= n <= 10^4
// 0 <= nums[i] <= n
// All the numbers of nums are unique.

//Code Structure:
/**
 * @param {number[]} nums
 * @return {number}
 */
var missingNumber = function(nums) {
    // Initialize the missing number to the length of the array
    let missing = nums.length;

    // Iterate through the array
    for (let i = 0; i < nums.length; i++) {
        // Add the current index to the missing number
        missing += i - nums[i];
    }

    // Return the missing number
    return missing;
};
    