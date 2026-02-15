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
        def backtrack(board, row, cols, diagonals, anti_diagonals):
            if row == n:
                solutions.append(["".join(row) for row in board])
                return

            for col in range(n):
                diagonal = row - col
                anti_diagonal = row + col

                if col in cols or diagonal in diagonals or anti_diagonal in anti_diagonals:
                    continue

                cols.add(col)
                diagonals.add(diagonal)
                anti_diagonals.add(anti_diagonal)
                board[row][col] = "Q"

                backtrack(board, row + 1, cols, diagonals, anti_diagonals)

                cols.remove(col)
                diagonals.remove(diagonal)
                anti_diagonals.remove(anti_diagonal)
                board[row][col] = "."

        solutions = []
        board = [["." for _ in range(n)] for _ in range(n)]
        backtrack(board, 0, set(), set(), set())
        return solutions                                               
    