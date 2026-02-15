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
class Solution {
    public int missingNumber(int[] nums) {
        int n = nums.length;
        int sum = n * (n + 1) / 2;
        for (int num : nums) {
            sum -= num;
        }
        return sum;
    }
}
    