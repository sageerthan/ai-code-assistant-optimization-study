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

/**
 * @param {string} s
 * @return {boolean}
 */
var isValid = function(s) {
    // Create an empty stack
    let stack = [];

    // Iterate through the string
    for (let i = 0; i < s.length; i++) {
        // If the current character is an opening bracket, push it onto the stack
        if (s[i] === '(' || s[i] === '[' || s[i] === '{') {
            stack.push(s[i]);
        }
        // If the current character is a closing bracket
        else {
            // If the stack is empty, return false
            if (stack.length === 0) {
                return false;
            }
            // If the closing bracket doesn't match the top of the stack, return false
            else if (
                (s[i] === ')' && stack[stack.length - 1] !== '(') ||
                (s[i] === ']' && stack[stack.length - 1] !== '[') ||
                (s[i] === '}' && stack[stack.length - 1] !== '{')
            ) {
                return false;
            }
            // Otherwise, pop the top element from the stack
            else {
                stack.pop();
            }
        }
    }

    // If the stack is empty, return true
    return stack.length === 0;
};
    