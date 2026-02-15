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
    if (n <= 2) {
        return n;
    }
    let prev2 = 1;
    let prev1 = 2;
    let current = 0;
    for (let i = 3; i <= n; i++) {
        current = prev1 + prev2;
        prev2 = prev1;
        prev1 = current;
    }
    return current;
};
    