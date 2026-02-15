/** https://leetcode.com/problems/longest-valid-parentheses */
// Problem: Longest Valid Parentheses

//Problem Description:
//Given a string containing just the characters '(' and ')', return the length of the longest valid (well-formed) parentheses substring.

// Constraints:
// 0 <= s.length <= 3 * 10^4
// s[i] is '(', or ')'.


//Code Structure:
/**
 * @param {string} s
 * @return {number}
 */
var longestValidParentheses = function(s) {
    let maxLength = 0;
    const stack = [-1]; // Initialize stack with -1 to handle base case

    for (let i = 0; i < s.length; i++) {
        if (s[i] === '(') {
            stack.push(i); // Push the index of '(' onto the stack
        } else {
            stack.pop(); // Pop the last index from the stack
            if (stack.length === 0) {
                stack.push(i); // If stack is empty, push current index as a new base
            } else {
                maxLength = Math.max(maxLength, i - stack[stack.length - 1]); // Calculate valid length
            }
        }
    }

    return maxLength; // Return the maximum length of valid parentheses substring   
};
    