# https://leetcode.com/problems/climbing-stairs/
# Problem: Climbing Stairs

#Problem Description:
#You are climbing a staircase. It takes n steps to reach the top.
#Each time you can either climb 1 or 2 steps. In how many distinct ways can you climb to the top?

# Constraints:
# 1 <= n <= 45

#Code Structure:

class Solution(object):
    def climbStairs(self, n):
        """
        :type n: int
        :rtype: int
        """
        if n < 3:
            return n
        a, b = 1, 2
        for _ in range(3, n + 1):
            a, b = b, a + b
        return b
    