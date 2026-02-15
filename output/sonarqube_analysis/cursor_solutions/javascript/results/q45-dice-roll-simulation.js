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

/**
 * @param {number} n
 * @param {number[]} rollMax
 * @return {number}
 */
var dieSimulator = function(n, rollMax) {
    const MOD = 1000000007;
    
    // dp[i][j][k] = number of sequences of length i ending with j consecutive k's
    const dp = Array(n + 1).fill().map(() => 
        Array(7).fill().map(() => Array(16).fill(0))
    );
    
    // Base case: empty sequence
    for (let j = 1; j <= 6; j++) {
        dp[0][j][0] = 1;
    }
    
    for (let i = 1; i <= n; i++) {
        for (let j = 1; j <= 6; j++) {
            for (let k = 1; k <= rollMax[j - 1]; k++) {
                // Add sequences ending with k consecutive j's
                dp[i][j][k] = dp[i - 1][j][k - 1];
            }
            
            // Add sequences ending with 1 consecutive j (from different previous numbers)
            for (let prev = 1; prev <= 6; prev++) {
                if (prev !== j) {
                    for (let k = 0; k <= rollMax[prev - 1]; k++) {
                        dp[i][j][1] = (dp[i][j][1] + dp[i - 1][prev][k]) % MOD;
                    }
                }
            }
        }
    }
    
    let result = 0;
    for (let j = 1; j <= 6; j++) {
        for (let k = 1; k <= rollMax[j - 1]; k++) {
            result = (result + dp[n][j][k]) % MOD;
        }
    }
    
    return result;
};
    