# https://leetcode.com/problems/n-queens/
# Problem: N-Queens

#Problem Description:
#The n-queens puzzle is the problem of placing n queens on an n x n chessboard such that no two queens attack each other.
#Given an integer n, return all distinct solutions to the n-queens puzzle. You may return the answer in any order.
#Each solution contains a distinct board configuration of the n-queens' placement, where 'Q' and '.' both indicate a queen and an empty space, respectively.

# Constraints:
# 1 <= n <= 9

#Code Structure:
class Solution(object):
    def solveNQueens(self, n):
        """
        :type n: int
        :rtype: List[List[str]]
        """
        def is_not_under_attack(row, col):
            return not (cols[col] or diag1[row - col] or diag2[row + col])

        def place_queen(row, col):
            queens[row] = col
            cols[col] = True
            diag1[row - col] = True
            diag2[row + col] = True

        def remove_queen(row, col):
            queens[row] = -1
            cols[col] = False
            diag1[row - col] = False
            diag2[row + col] = False

        def backtrack(row):
            if row == n:
                result.append(['.' * i + 'Q' + '.' * (n - i - 1) for i in queens])
                return
            for col in range(n):
                if is_not_under_attack(row, col):
                    place_queen(row, col)
                    backtrack(row + 1)
                    remove_queen(row, col)

        result = []
        queens = [-1] * n
        cols = [False] * n
        diag1 = [False] * (2 * n - 1)
        diag2 = [False] * (2 * n - 1)
        
        backtrack(0)
        return result                                               
    