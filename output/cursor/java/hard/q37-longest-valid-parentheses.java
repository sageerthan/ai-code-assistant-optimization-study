/** https://leetcode.com/problems/longest-valid-parentheses */
// Problem: Longest Valid Parentheses

//Problem Description:
//Given a string containing just the characters '(' and ')', return the length of the longest valid (well-formed) parentheses substring.

// Constraints:
// 0 <= s.length <= 3 * 10^4
// s[i] is '(', or ')'.

//Code Structure:
import java.util.Stack;

class Solution {
    public int longestValidParentheses(String s) {
        if (s == null || s.length() < 2) {
            return 0;
        }
        
        Stack<Integer> stack = new Stack<>();
        stack.push(-1); // Base for calculating length
        int maxLen = 0;
        
        for (int i = 0; i < s.length(); i++) {
            if (s.charAt(i) == '(') {
                // Push index of opening parenthesis
                stack.push(i);
            } else {
                // Closing parenthesis
                stack.pop();
                
                if (stack.isEmpty()) {
                    // No matching opening parenthesis, push current index as new base
                    stack.push(i);
                } else {
                    // Calculate length of valid parentheses substring
                    maxLen = Math.max(maxLen, i - stack.peek());
                }
            }
        }
        
        return maxLen;
    }
}
    