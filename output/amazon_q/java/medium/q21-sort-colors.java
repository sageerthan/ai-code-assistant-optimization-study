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
        int left = 0, right = nums.length - 1, index = 0;
        while (index <= right) {
            if (nums[index] == 0) {
                nums[index] = nums[left];
                nums[left] = 0;
                left++;
            }
            if (nums[index] == 2) {
                nums[index] = nums[right];
                nums[right] = 2;
                right--;
                index--;
            }
            index++;
        }
    }
}
    