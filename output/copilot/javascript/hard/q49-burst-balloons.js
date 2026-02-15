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
/**
 * @param {number[]} nums
 * @return {number}
 */
var maxCoins = function(nums) {
    const n = nums.length;
    const dp = Array.from({ length: n + 2 }, () => Array(n + 2).fill(0));
    
    // Extend the nums array with 1s at both ends
    const extendedNums = [1, ...nums, 1];
    
    // Fill the dp table
    for (let length = 1; length <= n; length++) {
        for (let left = 1; left <= n - length + 1; left++) {
            const right = left + length - 1;
            for (let i = left; i <= right; i++) {
                dp[left][right] = Math.max(dp[left][right], 
                    dp[left][i - 1] + dp[i + 1][right] + extendedNums[left - 1] * extendedNums[i] * extendedNums[right + 1]);
            }
        }
    }
    
    return dp[1][n]; // The result is stored in dp[1][n]    
};
    