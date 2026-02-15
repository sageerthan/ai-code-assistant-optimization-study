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

class Solution {
    public int findDuplicate(int[] nums) {
        // Use Floyd's Tortoise and Hare (Cycle Detection) algorithm
        int slow = nums[0];
        int fast = nums[0];

        // Find the intersection point
        do {
            slow = nums[slow];
            fast = nums[nums[fast]];
        } while (slow != fast);

        // Find the entrance to the cycle
        fast = nums[0];
        while (slow != fast) {
            slow = nums[slow];
            fast = nums[fast];
        }
        return slow;
    }
}
    