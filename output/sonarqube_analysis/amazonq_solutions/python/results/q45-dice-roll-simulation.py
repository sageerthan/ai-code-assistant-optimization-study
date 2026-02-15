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
        dp = [[0] * 6 for _ in range(n)]
        dp[0] = [1] * 6

        for i in range(1, n):
            for j in range(6):
                for k in range(6):
                    if k != j:
                        dp[i][j] += dp[i - 1][k]
                    elif i - rollMax[j] >= 0:
                        dp[i][j] += dp[i - rollMax[j]][j] - dp[i - rollMax[j] - 1][j]
                dp[i][j] %= 1000000007

        return sum(dp[-1]) % 1000000007                                                          
    