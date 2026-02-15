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
    