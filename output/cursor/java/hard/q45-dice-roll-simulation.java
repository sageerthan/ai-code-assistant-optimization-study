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


class Solution {
    private static final int MOD = 1000000007;
    
    public int dieSimulator(int n, int[] rollMax) {
        // dp[i][j][k] = number of sequences of length i ending with j consecutive k's
        int[][][] dp = new int[n + 1][7][16];
        
        // Base case: empty sequence
        for (int j = 1; j <= 6; j++) {
            dp[0][j][0] = 1;
        }
        
        for (int i = 1; i <= n; i++) {
            for (int j = 1; j <= 6; j++) {
                for (int k = 1; k <= rollMax[j - 1]; k++) {
                    // Add sequences ending with k consecutive j's
                    dp[i][j][k] = dp[i - 1][j][k - 1];
                }
                
                // Add sequences ending with 1 consecutive j (from different previous numbers)
                for (int prev = 1; prev <= 6; prev++) {
                    if (prev != j) {
                        for (int k = 0; k <= rollMax[prev - 1]; k++) {
                            dp[i][j][1] = (dp[i][j][1] + dp[i - 1][prev][k]) % MOD;
                        }
                    }
                }
            }
        }
        
        int result = 0;
        for (int j = 1; j <= 6; j++) {
            for (int k = 1; k <= rollMax[j - 1]; k++) {
                result = (result + dp[n][j][k]) % MOD;
            }
        }
        
        return result;
    }
}
    

// Debugged Code

class Solution {
    private static final int MOD = 1000000007;
    
    public int dieSimulator(int n, int[] rollMax) {
        // dp[roll][face][cnt] : sequences of length roll ending with 'face' appearing 'cnt' times consecutively
        int maxCnt = 15; // per constraints
        int[][][] dp = new int[n + 1][6][maxCnt + 1];

        // base: first roll
        for (int face = 0; face < 6; face++) {
            dp[1][face][1] = 1;
        }

        for (int len = 1; len < n; len++) {
            for (int face = 0; face < 6; face++) {
                for (int cnt = 1; cnt <= rollMax[face]; cnt++) {
                    int cur = dp[len][face][cnt];
                    if (cur == 0) continue;

                    // continue same face if allowed
                    if (cnt + 1 <= rollMax[face]) {
                        dp[len + 1][face][cnt + 1] = (dp[len + 1][face][cnt + 1] + cur) % MOD;
                    }

                    // switch to a different face
                    for (int next = 0; next < 6; next++) {
                        if (next == face) continue;
                        dp[len + 1][next][1] = (dp[len + 1][next][1] + cur) % MOD;
                    }
                }
            }
        }

        int ans = 0;
        for (int face = 0; face < 6; face++) {
            for (int cnt = 1; cnt <= rollMax[face]; cnt++) {
                ans = (ans + dp[n][face][cnt]) % MOD;
            }
        }

        return ans;
    }
}
    