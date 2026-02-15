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

/**
 * @param {number} n
 * @param {number[]} rollMax
 * @return {number}
 */
var dieSimulator = function(n, rollMax) {
    const MOD = 10 ** 9 + 7;
    const dp = Array.from({ length: n + 1 }, () => Array(7).fill(0));
    for (let i = 1; i <= 6; i++) {
        dp[1][i] = 1;
    }

    for (let i = 2; i <= n; i++) {
        for (let j = 1; j <= 6; j++) {
            for (let k = 1; k <= rollMax[j - 1]; k++) {
                if (i - k >= 1) {
                    for (let l = 1; l <= 6; l++) {
                        if (l !== j) {
                            dp[i][j] = (dp[i][j] + dp[i - k][l]) % MOD;
                        }
                    }
                }
            }
        }
    }

    let result = 0;
    for (let i = 1; i <= 6; i++) {
        result = (result + dp[n][i]) % MOD;
    }
    return result;
};
    

// Debugged Code:

/**
 * @param {number} n
 * @param {number[]} rollMax
 * @return {number}
 */
var dieSimulator = function(n, rollMax) {
    const MOD = 1000000007;
    if (n === 0) return 0;
    // dp[i][j][k]: number of sequences of length i, ending with face j (0-5),
    // with k consecutive j's (1..rollMax[j])
    const maxRoll = Math.max(...rollMax);
    const dp = Array.from({ length: n + 1 }, () =>
        Array.from({ length: 6 }, () => new Array(maxRoll + 1).fill(0))
    );

    // base case: first roll
    for (let j = 0; j < 6; j++) dp[1][j][1] = 1;

    for (let i = 2; i <= n; i++) {
        for (let j = 0; j < 6; j++) {
            // Case 1: previous roll is different -> consecutive count becomes 1
            let sumPrevDifferent = 0;
            for (let prev = 0; prev < 6; prev++) {
                if (prev === j) continue;
                const limit = rollMax[prev];
                for (let k = 1; k <= limit; k++) {
                    sumPrevDifferent = (sumPrevDifferent + dp[i - 1][prev][k]) % MOD;
                }
            }
            dp[i][j][1] = (dp[i][j][1] + sumPrevDifferent) % MOD;

            // Case 2: previous roll was same j -> increase consecutive count
            const limitJ = rollMax[j];
            for (let k = 2; k <= limitJ; k++) {
                dp[i][j][k] = (dp[i][j][k] + dp[i - 1][j][k - 1]) % MOD;
            }
        }
    }

    let res = 0;
    for (let j = 0; j < 6; j++) {
        for (let k = 1; k <= rollMax[j]; k++) {
            res = (res + dp[n][j][k]) % MOD;
        }
    }
    return res;
};
    