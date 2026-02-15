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
    const stack = [];
    const mapping = {')': '(', '}': '{', ']': '['};
    for (let i = 0; i < s.length; i++) {
        if (!mapping[s[i]]) {
            stack.push(s[i]);
        } else if (stack.pop() !== mapping[s[i]]) {
            return false;
        }
    }
    return !stack.length;
};
    