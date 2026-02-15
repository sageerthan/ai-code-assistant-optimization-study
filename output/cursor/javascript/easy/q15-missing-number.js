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
    const n = nums.length;
    
    // Calculate expected sum of numbers from 0 to n
    const expectedSum = n * (n + 1) / 2;
    
    // Calculate actual sum of numbers in the array
    const actualSum = nums.reduce((sum, num) => sum + num, 0);
    
    // The missing number is the difference
    return expectedSum - actualSum;
};
    