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
        // Create a stack to store the indices of the opening brackets
        Stack<Integer> stack = new Stack<>();
        // Push -1 onto the stack to handle the case where the first character is a closing bracket
        stack.push(-1);
        int maxLen = 0;
        // Loop through each character in the string
        for (int i = 0; i < s.length(); i++) {
            // If the character is an opening bracket, push its index onto the stack
            if (s.charAt(i) == '(') {
                stack.push(i);
            } else {
                // If the character is a closing bracket, pop the top element from the stack
                stack.pop();
                // If the stack is empty, push the current index onto the stack
                if (stack.isEmpty()) {
                    stack.push(i);
                } else {
                    // Calculate the length of the valid parentheses substring
                    maxLen = Math.max(maxLen, i - stack.peek());
                }
            }
        }
        return maxLen;
    }
}
    