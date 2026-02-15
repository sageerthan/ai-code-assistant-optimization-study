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

class Solution {
    public int dieSimulator(int n, int[] rollMax) {
        int MOD = 1000000007;
        int[][][] dp = new int[n + 1][6][16];
        
        for (int i = 0; i < 6; i++) {
            dp[1][i][1] = 1;
        }
        
        for (int i = 2; i <= n; i++) {
            for (int j = 0; j < 6; j++) {
                for (int k = 0; k < 6; k++) {
                    if (j == k) {
                        for (int c = 1; c < rollMax[j]; c++) {
                            dp[i][j][c + 1] = (dp[i][j][c + 1] + dp[i - 1][k][c]) % MOD;
                        }
                    } else {
                        for (int c = 1; c <= rollMax[k]; c++) {
                            dp[i][j][1] = (dp[i][j][1] + dp[i - 1][k][c]) % MOD;
                        }
                    }
                }
            }
        }
        
        int result = 0;
        for (int i = 0; i < 6; i++) {
            for (int j = 1; j <= rollMax[i]; j++) {
                result = (result + dp[n][i][j]) % MOD;
            }
        }
        return result;
    }
}
    