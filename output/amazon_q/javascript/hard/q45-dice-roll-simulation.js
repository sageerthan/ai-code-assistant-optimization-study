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

// First generated code


/**
 * @param {number} n
 * @param {number[]} rollMax
 * @return {number}
 */
var dieSimulator = function(n, rollMax) {
    const MOD = 1e9 + 7;
    const dp = Array.from({ length: n + 1 }, () => Array(6).fill(0).map(() => Array(16).fill(0)));
    
    for (let j = 0; j < 6; j++) {
        dp[1][j][1] = 1;
    }
    
    for (let i = 2; i <= n; i++) {
        for (let j = 0; j < 6; j++) {
            for (let k = 1; k <= 15; k++) {
                for (let p = 0; p < 6; p++) {
                    if (p !== j) {
                        dp[i][j][k] = (dp[i][j][k] + dp[i - 1][p][rollMax[p]]) % MOD;
                    } else if (k < rollMax[j]) {
                        dp[i][j][k + 1] = (dp[i][j][k + 1] + dp[i - 1][j][k]) % MOD;
                    }
                }
            }
        }
    }
    
    let result = 0;
    for (let j = 0; j < 6; j++) {
        for (let k = 1; k <= 15; k++) {
            result = (result + dp[n][j][k]) % MOD;
        }
    }
    
    return result;
};
    

// Debugged Code

/**
 * @param {number} n
 * @param {number[]} rollMax
 * @return {number}
 */
var dieSimulator = function(n, rollMax) {
    const MOD = 1e9 + 7;
    const dp = Array.from({ length: n + 1 }, () => Array(6).fill(0).map(() => Array(16).fill(0)));
    
    for (let j = 0; j < 6; j++) {
        dp[1][j][1] = 1;
    }
    
    for (let i = 2; i <= n; i++) {
        for (let j = 0; j < 6; j++) {
            for (let p = 0; p < 6; p++) {
                if (p !== j) {
                    for (let k = 1; k <= rollMax[p]; k++) {
                        dp[i][j][1] = (dp[i][j][1] + dp[i - 1][p][k]) % MOD;
                    }
                } else {
                    for (let k = 1; k < rollMax[j]; k++) {
                        dp[i][j][k + 1] = (dp[i][j][k + 1] + dp[i - 1][j][k]) % MOD;
                    }
                }
            }
        }
    }
    
    let result = 0;
    for (let j = 0; j < 6; j++) {
        for (let k = 1; k <= rollMax[j]; k++) {
            result = (result + dp[n][j][k]) % MOD;
        }
    }
    
    return result;
};
    