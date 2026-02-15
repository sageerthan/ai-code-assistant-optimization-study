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

const MOD = 10**9 + 7;

/**
 * @param {number} n
 * @param {number[]} rollMax
 * @return {number}
 */
var dieSimulator = function(n, rollMax) {
    let dp = Array(n + 1).fill(0).map(() => Array(7).fill(0));
    dp[0][0] = 1;
    for (let i = 1; i <= n; i++) {
        for (let j = 1; j <= 6; j++) {
            if (i <= rollMax[j - 1]) {
                dp[i][j] = (dp[i - 1][0] + dp[i - 1][j]) % MOD;
            } else {
                dp[i][j] = (dp[i - 1][0] + dp[i - 1][j] - dp[i - rollMax[j - 1] - 1][j]) % MOD;
                if (dp[i][j] < 0) dp[i][j] += MOD;
            }
        }
    }
    return dp[n][0];
};
    