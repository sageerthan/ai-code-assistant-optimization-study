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
            return n;
        }
        
        int prev2 = 1; // ways to reach step 1
        int prev1 = 2; // ways to reach step 2
        int current = 0;
        
        // Calculate ways to reach each step from 3 to n
        for (int i = 3; i <= n; i++) {
            current = prev1 + prev2; // ways to reach step i
            prev2 = prev1;           // update for next iteration
            prev1 = current;         // update for next iteration
        }
        
        return current;
    }
}
    