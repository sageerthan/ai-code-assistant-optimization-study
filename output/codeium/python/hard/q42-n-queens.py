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
        result = []
        board = [['.' for _ in range(n)] for _ in range(n)]
        self.dfs(result, board, 0)
        return result
    
    def dfs(self, result, board, row):
        if row == len(board):
            result.append(["".join(board[i]) for i in range(len(board))])
            return
        for i in range(len(board[0])):
            if self.is_valid(board, row, i):
                board[row][i] = 'Q'
                self.dfs(result, board, row + 1)
                board[row][i] = '.'
                
    def is_valid(self, board, row, col):
        for i in range(row):
            if board[i][col] == 'Q':
                return False
        for i, j in zip(range(row - 1, -1, -1), range(col + 1, len(board[0]))):
            if board[i][j] == 'Q':
                return False
        for i, j in zip(range(row - 1, -1, -1), range(col - 1, -1, -1)):
            if board[i][j] == 'Q':
                return False
        return True
    