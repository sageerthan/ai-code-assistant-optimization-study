/** https://leetcode.com/problems/valid-parentheses */
// Problem: Valid Parentheses

//Problem Description:
//Given a string s containing just the characters '(', ')', '{', '}', '[' and ']', determine if the input string is valid.
//An input string is valid if:
//Open brackets must be closed by the same type of brackets.
//Open brackets must be closed in the correct order.
//Every close bracket has a corresponding open bracket of the same type.

// Constraints:
// 1 <= s.length <= 104
// s consists of parentheses only '()[]{}'.

//Code Structure:

/**
 * @param {string} s
 * @return {boolean}
 */
var isValid = function(s) {
    const stack = []; // Stack to keep track of opening brackets
    const bracketMap = { '(': ')', '{': '}', '[': ']' }; // Map for matching brackets

    for (let char of s) {
        if (bracketMap[char]) {
            // If the character is an opening bracket, push it onto the stack
            stack.push(char);
        } else {
            // If the character is a closing bracket
            if (stack.length === 0 || bracketMap[stack.pop()] !== char) {
                // If the stack is empty or the top of the stack does not match the closing bracket
                return false;
            }
        }
    }

    // If the stack is empty, all brackets were matched correctly
    return stack.length === 0;
};
    