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
        
        # dp[i][j][k] = number of sequences of length i ending with j consecutive rolls of face k
        dp = [[[0] * 16 for _ in range(6)] for _ in range(n + 1)]
        
        # Initialize: sequences of length 1
        for face in range(6):
            dp[1][face][1] = 1
        
        for length in range(2, n + 1):
            for face in range(6):
                for consecutive in range(1, rollMax[face] + 1):
                    if consecutive == 1:
                        # Can end with 1 consecutive roll of this face
                        for prev_face in range(6):
                            if prev_face != face:
                                for prev_consecutive in range(1, rollMax[prev_face] + 1):
                                    dp[length][face][1] = (dp[length][face][1] + dp[length - 1][prev_face][prev_consecutive]) % MOD
                    else:
                        # Can extend previous consecutive rolls of the same face
                        dp[length][face][consecutive] = dp[length - 1][face][consecutive - 1]
        
        # Sum all valid sequences of length n
        result = 0
        for face in range(6):
            for consecutive in range(1, rollMax[face] + 1):
                result = (result + dp[n][face][consecutive]) % MOD
        
        return result
    