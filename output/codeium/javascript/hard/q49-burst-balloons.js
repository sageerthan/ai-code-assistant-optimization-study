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

// First generated code
/**
 * @param {number[]} nums
 * @return {number}
 */
var maxCoins = function(nums) {
    let n = nums.length;
    let dp = Array(n+2).fill(0).map(() => Array(n+2).fill(0));
    for (let length = 1; length <= n; length++) {
        for (let left = 1; left <= n - length + 1; left++) {
            let right = left + length - 1;
            for (let i = left; i <= right; i++) {
                dp[left][right] = Math.max(dp[left][right], dp[left][i-1] + dp[i+1][right] + nums[left-1] * nums[i] * nums[right+1]);
            }
        }
    }
    return dp[1][n];
};

// Debugged Code

/**
 * @param {number[]} nums
 * @return {number}
 */
var maxCoins = function(nums) {
    let n = nums.length;
    let dp = Array(n+2).fill(0).map(() => Array(n+2).fill(0));
    nums.unshift(1);
    nums.push(1);
    for (let i = 2; i < n+2; i++) {
        for (let j = i-2; j >= 0; j--) {
            for (let k = i; k < n+2; k++) {
                if (nums[j] < nums[i] && nums[i] < nums[k]) {
                    dp[j][k] = Math.max(dp[j][k], dp[j][i-1] + dp[i+1][k] + nums[j] * nums[i] * nums[k]);
                }
            }
        }
    }
    return dp[1][n+1];
};
    