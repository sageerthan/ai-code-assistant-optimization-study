/** https://leetcode.com/problems/n-queens */
// Problem: N-Queens

//Problem Description:
//The n-queens puzzle is the problem of placing n queens on an n x n chessboard such that no two queens attack each other.
//Given an integer n, return all distinct solutions to the n-queens puzzle. You may return the answer in any order.
//Each solution contains a distinct board configuration of the n-queens' placement, where 'Q' and '.' both indicate a queen and an empty space, respectively.

// Constraints:
// 1 <= n <= 9

//Code Structure:
class Solution {
    public List<List<String>> solveNQueens(int n) {
        List<List<String>> result = new ArrayList<>();
        Set<Integer> cols = new HashSet<>();
        Set<Integer> diag1 = new HashSet<>();
        Set<Integer> diag2 = new HashSet<>();
        backtrack(result, new ArrayList<>(), 0, n, cols, diag1, diag2);
        return result;
    }
    
    private void backtrack(List<List<String>> result, List<String> board, int row, int n, Set<Integer> cols, Set<Integer> diag1, Set<Integer> diag2) {
        if (row == n) {
            result.add(new ArrayList<>(board));
            return;
        }
        for (int col = 0; col < n; col++) {
            if (cols.contains(col) || diag1.contains(row - col) || diag2.contains(row + col)) continue;
            
            cols.add(col);
            diag1.add(row - col);
            diag2.add(row + col);
            
            char[] rowChars = new char[n];
            Arrays.fill(rowChars, '.');
            rowChars[col] = 'Q';
            board.add(new String(rowChars));
            
            backtrack(result, board, row + 1, n, cols, diag1, diag2);
            
            board.remove(board.size() - 1);
            cols.remove(col);
            diag1.remove(row - col);
            diag2.remove(row + col);
        }
    }
}
    