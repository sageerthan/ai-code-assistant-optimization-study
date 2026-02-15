# https://leetcode.com/problems/dice-roll-simulation/
# Problem: Dice Roll Simulation

#Problem Description:
#A die simulator generates a random number from 1 to 6 for each roll. You introduced a constraint to the generator such that it cannot roll the number i more than rollMax[i] (1-indexed) consecutive times.
#Given an array of integers rollMax and an integer n, return the number of distinct sequences that can be obtained with exact n rolls. Since the answer may be too large, return it modulo 109 + 7.
#Two sequences are considered different if at least one element differs from each other.

# Constraints:
# 1 <= n <= 5000
# rollMax.length == 6
# 1 <= rollMax[i] <= 15

#Code Structure:

# First generated code

class Solution(object):
    def dieSimulator(self, n, rollMax):
        MOD = 10**9 + 7
        dp = [[0]*7 for _ in range(n+1)]
        dp[0][0] = 1
        for i in range(1, n+1):
            for j in range(1, 7):
                if i <= rollMax[j-1]:
                    dp[i][j] = (dp[i-1][0] + dp[i-1][j]) % MOD
                else:
                    dp[i][j] = (dp[i-1][0] + dp[i-1][j] - dp[i-rollMax[j-1]-1][j]) % MOD
                    if dp[i][j] < 0:
                        dp[i][j] += MOD
        return sum(dp[n]) % MOD
    
# Debugged Code

class Solution(object):
    def dieSimulator(self, n, rollMax):
        MOD = 10**9 + 7
        dp = [[0]*7 for _ in range(n+1)]
        dp[0] = [1]*7
        for i in range(1, n+1):
            for j in range(6, 0, -1):
                if i <= rollMax[j-1]:
                    dp[i][j] = (dp[i-1][0] + dp[i-1][j]) % MOD
                else:
                    dp[i][j] = (dp[i-1][0] + dp[i-1][j] - dp[i-rollMax[j-1]-1][j]) % MOD
                    if dp[i][j] < 0:
                        dp[i][j] += MOD
        return sum(dp[n]) % MOD