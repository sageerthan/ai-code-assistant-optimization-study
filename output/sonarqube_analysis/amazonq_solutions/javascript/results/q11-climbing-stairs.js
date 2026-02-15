/** https://leetcode.com/problems/climbing-stairs */
// Problem: Climbing Stairs

//Problem Description:
//You are climbing a staircase. It takes n steps to reach the top.
//Each time you can either climb 1 or 2 steps. In how many distinct ways can you climb to the top?

// Constraints:
// 1 <= n <= 45

//Code Structure:

/**
 * @param {number} n
 * @return {number}
 */
var climbStairs = function(n) {
    // Create an array to store the number of ways to climb each step
    let dp = new Array(n + 1).fill(0);

    // Base cases
    dp[0] = 1;
    dp[1] = 1;

    // Iterate through the steps
    for (let i = 2; i <= n; i++) {
        // The number of ways to climb the current step is the sum of the ways to climb the previous two steps
        dp[i] = dp[i - 1] + dp[i - 2];
    }

    // Return the number of ways to climb the top step
    return dp[n];
};
    