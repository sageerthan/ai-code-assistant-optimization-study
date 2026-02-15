/** https://leetcode.com/problems/sort-colors */
// Problem: Sort Colors

//Problem Description:
//Given an array nums with n objects colored red, white, or blue, sort them in-place so that objects of the same color are adjacent, with the colors in the order red, white, and blue.
//We will use the integers 0, 1, and 2 to represent the color red, white, and blue, respectively.
//You must solve this problem without using the library's sort function.

// Constraints:
// n == nums.length
// 1 <= n <= 300
// nums[i] is either 0, 1, or 2.

//Code Structure:

class Solution {
    public void sortColors(int[] nums) {
        int red = 0, white = 0, blue = 0;

        // Count the number of each color
        for (int num : nums) {
            if (num == 0) red++;
            else if (num == 1) white++;
            else if (num == 2) blue++;
        }

        // Refill the array with the sorted colors
        for (int i = 0; i < red; i++) nums[i] = 0;
        for (int i = red; i < red + white; i++) nums[i] = 1;
        for (int i = red + white; i < nums.length; i++) nums[i] = 2;
    }
}
    