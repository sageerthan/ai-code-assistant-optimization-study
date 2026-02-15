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
    

// Debugged Code:

/**
 * @param {number} n
 * @param {number[]} rollMax
 * @return {number}
 */
var dieSimulator = function (n, rollMax) {
  const MOD = 1_000_000_007;
  const maxRun = Math.max(...rollMax); // up to 15

  // dp[length][face][run] where face in [0..5], run in [1..maxRun]
  const dp = Array.from({ length: n + 1 }, () =>
    Array.from({ length: 6 }, () => Array(maxRun + 1).fill(0))
  );

  // base: sequences of length 1
  for (let f = 0; f < 6; f++) dp[1][f][1] = 1;

  for (let len = 2; len <= n; len++) {
    for (let f = 0; f < 6; f++) {
      const limit = rollMax[f];

      // continue the same face if under its limit
      for (let run = 2; run <= limit; run++) {
        dp[len][f][run] = (dp[len][f][run] + dp[len - 1][f][run - 1]) % MOD;
      }

      // switch from any other face -> run length 1
      let fromOthers = 0;
      for (let pf = 0; pf < 6; pf++) {
        if (pf === f) continue;
        const prevLimit = rollMax[pf];
        for (let run = 1; run <= prevLimit; run++) {
          fromOthers += dp[len - 1][pf][run];
          if (fromOthers >= MOD) fromOthers -= MOD;
        }
      }
      dp[len][f][1] = (dp[len][f][1] + fromOthers) % MOD;
    }
  }

  // sum all ways of length n
  let ans = 0;
  for (let f = 0; f < 6; f++) {
    const limit = rollMax[f];
    for (let run = 1; run <= limit; run++) {
      ans += dp[n][f][run];
      if (ans >= MOD) ans -= MOD;
    }
  }
  return ans;
};