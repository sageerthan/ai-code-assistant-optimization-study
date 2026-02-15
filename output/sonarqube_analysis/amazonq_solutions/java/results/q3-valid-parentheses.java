/** https://leetcode.com/problems/valid-parentheses */
// Problem: Valid Parentheses

//Problem Description:
//Given a string s containing just the characters '(', ')', '{', '}', '[' and ']', determine if the input string is valid.
//An input string is valid if:
//Open brackets must be closed by the same type of brackets.
//Open brackets must be closed in the correct order.
//Every close bracket has a corresponding open bracket of the same type.

// Constraints:
// 1 <= s.length <= 10^4
// s consists of parentheses only '()[]{}'.

//Code Structure:

import java.util.Stack;
class Solution {
    public boolean isValid(String s) {
        // Create a stack to store the opening brackets
        Stack<Character> stack = new Stack<>();
        // Loop through each character in the string
        for (char c : s.toCharArray()) {
            // If the character is an opening bracket, push it onto the stack
            if (c == '(' || c == '[' || c == '{') {
                stack.push(c);
            }
            // If the character is a closing bracket
            else if (c == ')' || c == ']' || c == '}') {
                // If the stack is empty, return false
                if (stack.isEmpty()) {
                    return false;
                }
                // Pop the top element from the stack
                char top = stack.pop();
                // If the popped element is not the corresponding opening bracket, return false
                if ((c == ')' && top != '(') || (c == ']' && top != '[') || (c == '}' && top != '{')) {
                    return false;
                }
            }
        }
        // If the stack is empty, return true
        return stack.isEmpty();
    }
}
    