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

# First generated code:

class Solution(object):
    def dieSimulator(self, n, rollMax):
        """
        :type n: int
        :type rollMax: List[int]
        :rtype: int
        """ 
        MOD = 10**9 + 7
        dp = [[0] * 6 for _ in range(n + 1)]
        
        for i in range(6):
            dp[1][i] = 1
        
        for i in range(2, n + 1):
            for j in range(6):
                dp[i][j] = sum(dp[i - 1]) % MOD
                for k in range(1, rollMax[j]):
                    if i - k - 1 >= 0:
                        dp[i][j] = (dp[i][j] - dp[i - k - 1][j]) % MOD
        
        return sum(dp[n]) % MOD                                                         
    

# Debugged Code

class Solution(object):
    def dieSimulator(self, n, rollMax):
        """
        :type n: int
        :type rollMax: List[int]
        :rtype: int
        """ 
        MOD = 10**9 + 7
        
        # dp[i][j][k] = number of sequences of length i, ending with face j (0-5),
        # with k consecutive j's (1..rollMax[j])
        dp = [[[0] * 16 for _ in range(6)] for _ in range(n + 1)]
        
        # Base case: first roll
        for j in range(6):
            dp[1][j][1] = 1
        
        # Fill DP table
        for i in range(2, n + 1):
            for j in range(6):
                # Case 1: previous roll is different -> consecutive count becomes 1
                for prev_j in range(6):
                    if prev_j != j:
                        for k in range(1, rollMax[prev_j] + 1):
                            dp[i][j][1] = (dp[i][j][1] + dp[i - 1][prev_j][k]) % MOD
                
                # Case 2: previous roll was same j -> increase consecutive count
                for k in range(2, rollMax[j] + 1):
                    dp[i][j][k] = (dp[i][j][k] + dp[i - 1][j][k - 1]) % MOD
        
        # Sum all valid ending states
        result = 0
        for j in range(6):
            for k in range(1, rollMax[j] + 1):
                result = (result + dp[n][j][k]) % MOD
        
        return result                                                         
    