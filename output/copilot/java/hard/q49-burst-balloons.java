/** https://leetcode.com/problems/burst-balloons */
// Problem: Burst Balloons

//Problem Description:
//You are given n balloons, indexed from 0 to n - 1. Each balloon is painted with a number on it represented by an array nums. You are asked to burst all the balloons.
//If you burst the ith balloon, you will get nums[i - 1] * nums[i] * nums[i + 1] coins. If i - 1 or i + 1 goes out of bounds of the array, then treat it as if there is a balloon with a 1 painted on it.
//Return the maximum coins you can collect by bursting the balloons wisely.

// Constraints:
// n == nums.length
// 1 <= n <= 300
// 0 <= nums[i] <= 100

//Code Structure:
class Solution {
    public int maxCoins(int[] nums) {
        int n = nums.length;
        // Create a new array with 1s at both ends
        int[] balloons = new int[n + 2];
        balloons[0] = 1;
        balloons[n + 1] = 1;
        for (int i = 0; i < n; i++) {
            balloons[i + 1] = nums[i];
        }

        // dp[i][j] will store the maximum coins that can be collected by bursting balloons from index i to j
        int[][] dp = new int[n + 2][n + 2];

        // Iterate over the length of the subarray
        for (int length = 1; length <= n; length++) {
            for (int left = 0; left <= n - length; left++) {
                int right = left + length + 1; // right is exclusive
                for (int k = left + 1; k < right; k++) {
                    // Calculate coins if we burst balloon k last in the range [left, right]
                    int coins = balloons[left] * balloons[k] * balloons[right];
                    dp[left][right] = Math.max(dp[left][right], dp[left][k] + dp[k][right] + coins);
                }
            }
        }

        return dp[0][n + 1]; // The result is stored in dp[0][n+1]
    }
}
    