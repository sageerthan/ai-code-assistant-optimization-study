/** https://leetcode.com/problems/climbing-stairs */
// Problem: Climbing Stairs

//Problem Description:
//You are climbing a staircase. It takes n steps to reach the top.
//Each time you can either climb 1 or 2 steps. In how many distinct ways can you climb to the top?

// Constraints:
// 1 <= n <= 45

//Code Structure:

class Solution {
    public int climbStairs(int n) {
        if (n <= 2) {
            return n; // Base cases: 1 way for 1 step, 2 ways for 2 steps
        }
        
        int first = 1; // Ways to climb to step 1
        int second = 2; // Ways to climb to step 2
        int current = 0; // Variable to hold the current number of ways
        
        for (int i = 3; i <= n; i++) {
            current = first + second; // Current ways is the sum of the previous two
            first = second; // Move to the next step
            second = current; // Update second to current
        }
        
        return current; // Return the total ways to climb n steps    
    }
}
    