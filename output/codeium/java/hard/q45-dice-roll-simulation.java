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
        final int MOD = 1000000007;
        int[] dp = new int[n+1];
        dp[0] = 1;
        for (int i = 1; i <= n; i++) {
            dp[i] = 0;
            for (int j = 1; j <= 6; j++) {
                if (i - 1 - rollMax[j - 1] >= 0) {
                    dp[i] = (dp[i] - dp[i - 1 - rollMax[j - 1]] + MOD) % MOD;
                }
                if (i - 1 >= 0) {
                    dp[i] = (dp[i] + dp[i-1]) % MOD;
                }
            }
        }
        return dp[n];
    }
}


// Debugged code:

class Solution {
    public int dieSimulator(int n, int[] rollMax) {
        final int MOD = 1000000007;
        int[] dp = new int[n+1];
        dp[0] = 1;
        int[] count = new int[7]; // count[i] represents the number of rolls that have been used for number i
        Arrays.fill(count, 1);
        for (int i = 1; i <= n; i++) {
            int prevCount = dp[i-1];
            dp[i] = 0;
            for (int j = 1; j <= 6; j++) {
                if (count[j] < rollMax[j-1]) {
                    dp[i] = (dp[i] + prevCount) % MOD;
                }
                count[j]++;
            }
        }
        return dp[n];
    }
}