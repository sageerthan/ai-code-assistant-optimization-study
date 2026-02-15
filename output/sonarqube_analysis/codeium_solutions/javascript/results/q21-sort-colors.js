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

/**
 * @param {number[]} nums
 * @return {void} Do not return anything, modify nums in-place instead.
 */
var sortColors = function(nums) {
    let [red, white, blue] = [0, 0, 0];
    for (let num of nums) {
        switch (num) {
            case 0:
                red++;
                break;
            case 1:
                white++;
                break;
            case 2:
                blue++;
                break;
        }
    }
    let i = 0;
    while (red--) {
        nums[i++] = 0;
    }
    while (white--) {
        nums[i++] = 1;
    }
    while (blue--) {
        nums[i++] = 2;
    }
};
    