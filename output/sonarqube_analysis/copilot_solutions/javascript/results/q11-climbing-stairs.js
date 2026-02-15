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
    if (n <= 2) return n; // Base cases: if n is 1 or 2, return n

    let first = 1; // Represents the number of ways to climb to the (n-2)th step
    let second = 2; // Represents the number of ways to climb to the (n-1)th step
    let current; // Represents the number of ways to climb to the nth step

    for (let i = 3; i <= n; i++) {
        current = first + second; // The current step can be reached from either the (n-1)th or (n-2)th step
        first = second; // Move to the next step
        second = current; // Update second to be the current value
    }

    return current; // Return the total number of ways to reach the nth step  
};
    