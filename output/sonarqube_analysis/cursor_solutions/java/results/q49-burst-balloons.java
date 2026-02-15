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
        int[] balloons = new int[n + 2];
        balloons[0] = 1;
        balloons[n + 1] = 1;
        
        for (int i = 0; i < n; i++) {
            balloons[i + 1] = nums[i];
        }
        
        int[][] memo = new int[n + 2][n + 2];
        return burst(balloons, 1, n, memo);
    }
    
    private int burst(int[] balloons, int left, int right, int[][] memo) {
        if (left > right) {
            return 0;
        }
        
        if (memo[left][right] != 0) {
            return memo[left][right];
        }
        
        int maxCoins = 0;
        
        // Try bursting each balloon in the range [left, right] as the last one
        for (int k = left; k <= right; k++) {
            int coins = balloons[left - 1] * balloons[k] * balloons[right + 1];
            coins += burst(balloons, left, k - 1, memo);
            coins += burst(balloons, k + 1, right, memo);
            maxCoins = Math.max(maxCoins, coins);
        }
        
        memo[left][right] = maxCoins;
        return maxCoins;
    }
}
    