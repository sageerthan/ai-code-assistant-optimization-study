# https://leetcode.com/problems/set-matrix-zeroes/
# Problem: Set Matrix Zeroes

#Problem Description:
#Given an m x n integer matrix matrix, if an element is 0, set its entire row and column to 0's.

# Constraints:
# m == matrix.length
# n == matrix[0].length
# 1 <= m, n <= 200
# -2^31 <= matrix[i][j] <= 2^31 - 1

#Code Structure:

class Solution(object):
    def setZeroes(self, matrix):
        """
        :type matrix: List[List[int]]
        :rtype: None Do not return anything, modify matrix in-place instead.
        """ 
        rows, cols = len(matrix), len(matrix[0])
        row_zero = False
        
        # Check if the first row needs to be zeroed
        for j in range(cols):
            if matrix[0][j] == 0:
                row_zero = True
                break
        
        # Use the first row and column to mark zeroes
        for i in range(1, rows):
            for j in range(1, cols):
                if matrix[i][j] == 0:
                    matrix[i][0] = 0
                    matrix[0][j] = 0
        
        # Zero out cells based on marks
        for i in range(1, rows):
            for j in range(1, cols):
                if matrix[i][0] == 0 or matrix[0][j] == 0:
                    matrix[i][j] = 0
        
        # Zero out the first row if needed
        if row_zero:
            for j in range(cols):
                matrix[0][j] = 0
        
        # Zero out the first column if needed
        for i in range(rows):
            if matrix[i][0] == 0:
                for j in range(cols):
                    matrix[i][j] = 0
        for j in range(cols):
            if matrix[0][j] == 0:
                for i in range(rows):
                    matrix[i][j] = 0
        return matrix
                                                                                 
    