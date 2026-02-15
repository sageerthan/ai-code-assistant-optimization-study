/** https://leetcode.com/problems/find-the-duplicate-number */
// Problem: Find the Duplicate Number

//Problem Description:
//Given an array of integers nums containing n + 1 integers where each integer is in the range [1, n] inclusive.
//There is only one repeated number in nums, return this repeated number.
//You must solve the problem without modifying the array nums and using only constant extra space.

// Constraints:
// 1 <= n <= 10^5
// nums.length == n + 1
// 1 <= nums[i] <= n
// All the integers in nums appear only once except for precisely one integer which appears two or more times.

//Code Structure:

/**
 * @param {number[]} nums
 * @return {number}
 */
var findDuplicate = function(nums) {
    let slow = nums[0]; // Start slow pointer at the first element
    let fast = nums[0]; // Start fast pointer at the first element

    // Phase 1: Finding the intersection point
    do {
        slow = nums[slow]; // Move slow pointer by one step
        fast = nums[nums[fast]]; // Move fast pointer by two steps
    } while (slow !== fast);

    // Phase 2: Finding the entrance to the cycle
    slow = nums[0]; // Reset slow pointer to the start
    while (slow !== fast) {
        slow = nums[slow]; // Move slow pointer by one step
        fast = nums[fast]; // Move fast pointer by one step
    }

    return slow; // The duplicate number is where both pointers meet   
};
    