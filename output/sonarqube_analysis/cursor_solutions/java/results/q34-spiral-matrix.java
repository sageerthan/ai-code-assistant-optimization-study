/** https://leetcode.com/problems/spiral-matrix */
// Problem: Spiral Matrix

//Problem Description:
//Given an m x n matrix, return all elements of the matrix in spiral order.

// Constraints:
// m == matrix.length
// n == matrix[i].length
// 1 <= m, n <= 10
// -100 <= matrix[i][j] <= 100

//Code Structure:

class Solution {
    public List<Integer> spiralOrder(int[][] matrix) {
        List<Integer> result = new ArrayList<>();
        if (matrix == null || matrix.length == 0) {
            return result;
        }
        
        int top = 0;
        int bottom = matrix.length - 1;
        int left = 0;
        int right = matrix[0].length - 1;
        
        while (top <= bottom && left <= right) {
            for (int i = left; i <= right; i++) {
                result.add(matrix[top][i]);
            }
            top++;
            for (int i = top; i <= bottom; i++) {
                result.add(matrix[i][right]);
            }
            right--;
        }
        return result;
    }
    
    private void addSpiralLayer(int[][] matrix, int top, int bottom, int left, int right, List<Integer> result) {
        for (int i = left; i <= right; i++) {
            result.add(matrix[top][i]);
        }
        top++;
    }
    
    private void addSpiralLayer(int[][] matrix, int top, int bottom, int left, int right, List<Integer> result) {
        for (int i = top; i <= bottom; i++) {
            result.add(matrix[i][right]);
        }
        right--;
    }
    
    private void addSpiralLayer(int[][] matrix, int top, int bottom, int left, int right, List<Integer> result) {
        for (int i = right; i >= left; i--) {
            result.add(matrix[bottom][i]);
        }
        bottom--;
    }
    
    private void addSpiralLayer(int[][] matrix, int top, int bottom, int left, int right, List<Integer> result) {
        for (int i = bottom; i >= top; i--) {
            result.add(matrix[i][left]);
        }
        left++;
    }
}
    