/** https://leetcode.com/problems/longest-valid-parentheses */
// Problem: Longest Valid Parentheses

//Problem Description:
//Given a string containing just the characters '(' and ')', return the length of the longest valid (well-formed) parentheses substring.

// Constraints:
// 0 <= s.length <= 3 * 10^4
// s[i] is '(', or ')'.

//Code Structure:
class Solution {
    public int longestValidParentheses(String s) {
        int maxLength = 0;
        int lastInvalidIndex = -1; // To track the last index of an invalid parenthesis

        // Stack to keep track of indices of '(' characters
        Stack<Integer> stack = new Stack<>();

        for (int i = 0; i < s.length(); i++) {
            char c = s.charAt(i);

            if (c == '(') {
                stack.push(i); // Push the index of '(' onto the stack
            } else {
                if (stack.isEmpty()) {
                    // If we encounter a ')' without a matching '(', mark this as invalid
                    lastInvalidIndex = i;
                } else {
                    // Pop the matching '(' index from the stack
                    stack.pop();
                    if (stack.isEmpty()) {
                        // If the stack is empty, calculate the length from last invalid index
                        maxLength = Math.max(maxLength, i - lastInvalidIndex);
                    } else {
                        // If the stack is not empty, calculate length from the top of the stack
                        maxLength = Math.max(maxLength, i - stack.peek());
                    }
                }
            }
        }

        return maxLength; // Return the maximum length of valid parentheses substring found   
    }
}
    