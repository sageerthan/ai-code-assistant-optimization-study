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
    if (!s || s.length < 2) {
        return 0;
    }
    
    const stack = [];
    stack.push(-1); // Base for calculating length
    let maxLen = 0;
    
    for (let i = 0; i < s.length; i++) {
        if (s[i] === '(') {
            // Push index of opening parenthesis
            stack.push(i);
        } else {
            // Closing parenthesis
            stack.pop();
            
            if (stack.length === 0) {
                // No matching opening parenthesis, push current index as new base
                stack.push(i);
            } else {
                // Calculate length of valid parentheses substring
                maxLen = Math.max(maxLen, i - stack[stack.length - 1]);
            }
        }
    }
    
    return maxLen;
};