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
        self.backtrack(board, 0, result)
        return result
    
    def backtrack(self, board, row, result):
        """
        Backtrack to find all valid queen placements
        """
        if row == len(board):
            # Convert board to the required format
            solution = [''.join(row) for row in board]
            result.append(solution)
            return
        
        for col in range(len(board)):
            if self.isValid(board, row, col):
                board[row][col] = 'Q'
                self.backtrack(board, row + 1, result)
                board[row][col] = '.'
    
    def isValid(self, board, row, col):
        """
        Check if placing a queen at (row, col) is valid
        """
        # Check column
        for i in range(row):
            if board[i][col] == 'Q':
                return False
        
        # Check diagonal (top-left to bottom-right)
        i, j = row - 1, col - 1
        while i >= 0 and j >= 0:
            if board[i][j] == 'Q':
                return False
            i -= 1
            j -= 1
        
        # Check diagonal (top-right to bottom-left)
        i, j = row - 1, col + 1
        while i >= 0 and j < len(board):
            if board[i][j] == 'Q':
                return False
            i -= 1
            j += 1
        
        return True
    