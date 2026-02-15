/** https://leetcode.com/problems/dice-roll-simulation */
// Problem: Dice Roll Simulation

//Problem Description:
//A die simulator generates a random number from 1 to 6 for each roll. You introduced a constraint to the generator such that it cannot roll the number i more than rollMax[i] (1-indexed) consecutive times.
//Given an array of integers rollMax and an integer n, return the number of distinct sequences that can be obtained with exact n rolls. Since the answer may be too large, return it modulo 109 + 7.
//Two sequences are considered different if at least one element differs from each other.

// Constraints:
// 1 <= n <= 5000
// rollMax.length == 6
// 1 <= rollMax[i] <= 15

//Code Structure:

// First generated code:

class Solution {
    public int dieSimulator(int n, int[] rollMax) {
        int MOD = 1000000007;
        long[][] dp = new long[n + 1][6];
        
        // Initialize the first roll
        for (int i = 0; i < 6; i++) {
            dp[1][i] = 1;
        }
        
        // Fill the dp table
        for (int i = 2; i <= n; i++) {
            for (int j = 0; j < 6; j++) {
                // Calculate the number of ways to roll the die
                for (int k = 0; k < 6; k++) {
                    if (k != j) {
                        dp[i][j] = (dp[i][j] + dp[i - 1][k]) % MOD;
                    } else {
                        // If rolling the same number, check the rollMax constraint
                        for (int m = 1; m <= rollMax[j] && m < i; m++) {
                            dp[i][j] = (dp[i][j] + dp[i - m][k]) % MOD;
                        }
                    }
                }
            }
        }
        
        // Sum up all the ways to roll the die after n rolls
        long result = 0;
        for (int i = 0; i < 6; i++) {
            result = (result + dp[n][i]) % MOD;
        }
        
        return (int) result;    
    }
}

// Debugged Code:

class Solution {
    public int dieSimulator(int n, int[] rollMax) {
        int MOD = 1000000007;
        
        // dp[i][j][k] = number of ways to roll i times, last roll is j, 
        // and we have k consecutive rolls of j
        long[][][] dp = new long[n + 1][6][16];
        
        // Initialize the first roll - each die face can be rolled once
        for (int j = 0; j < 6; j++) {
            dp[1][j][1] = 1;
        }
        
        // Fill the dp table
        for (int i = 2; i <= n; i++) {
            for (int j = 0; j < 6; j++) {
                // Case 1: Roll a different number (reset consecutive count to 1)
                for (int prevJ = 0; prevJ < 6; prevJ++) {
                    if (prevJ != j) {
                        for (int k = 1; k <= rollMax[prevJ]; k++) {
                            dp[i][j][1] = (dp[i][j][1] + dp[i - 1][prevJ][k]) % MOD;
                        }
                    }
                }
                
                // Case 2: Roll the same number (increment consecutive count)
                for (int k = 1; k < rollMax[j]; k++) {
                    dp[i][j][k + 1] = (dp[i][j][k + 1] + dp[i - 1][j][k]) % MOD;
                }
            }
        }
        
        // Sum up all the ways to roll the die after n rolls
        long result = 0;
        for (int j = 0; j < 6; j++) {
            for (int k = 1; k <= rollMax[j]; k++) {
                result = (result + dp[n][j][k]) % MOD;
            }
        }
        
        return (int) result;
    }
}
    