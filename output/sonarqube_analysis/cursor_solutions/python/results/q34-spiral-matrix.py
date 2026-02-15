# https://leetcode.com/problems/spiral-matrix/
# Problem: Spiral Matrix

#Problem Description:
#Given an m x n matrix, return all elements of the matrix in spiral order.

# Constraints:
# m == matrix.length
# n == matrix[i].length
# 1 <= m, n <= 10
# -100 <= matrix[i][j] <= 100

#Code Structure:

class Solution(object):
    def spiralOrder(self, matrix):
        """
        :type matrix: List[List[int]]
        :rtype: List[int]
        """
        if not matrix or not matrix[0]:
            return []
        
        m = len(matrix)
        n = len(matrix[0])
        result = []
        
        top = 0
        bottom = m - 1
        left = 0
        right = n - 1
        
        while top <= bottom and left <= right:
            # Traverse right
            for j in range(left, right + 1):
                result.append(matrix[top][j])
            top += 1
            
            # Traverse down
            for i in range(top, bottom + 1):
                result.append(matrix[i][right])
            right -= 1
            
            # Traverse left (if we still have rows)
            if top <= bottom:
                for j in range(right, left - 1, -1):
                    result.append(matrix[bottom][j])
                bottom -= 1
            
            # Traverse up (if we still have columns)
            if left <= right:
                for i in range(bottom, top - 1, -1):
                    result.append(matrix[i][left])
                left += 1
        
        return result
    