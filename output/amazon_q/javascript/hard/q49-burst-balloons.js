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
    const arr = [1, ...nums, 1];
    const dp = Array(n + 2).fill().map(() => Array(n + 2).fill(0));
    
    for (let len = 2; len < n + 2; len++) {
        for (let left = 0; left < n + 2 - len; left++) {
            const right = left + len;
            for (let k = left + 1; k < right; k++) {
                dp[left][right] = Math.max(
                    dp[left][right],
                    dp[left][k] + dp[k][right] + arr[left] * arr[k] * arr[right]
                );
            }
        }
    }
    
    return dp[0][n + 1];
};
    