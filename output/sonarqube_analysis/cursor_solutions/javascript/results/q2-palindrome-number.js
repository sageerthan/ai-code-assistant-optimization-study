/** https://leetcode.com/problems/palindrome-number */
// Problem: Palindrome Number

//Problem Description:
//Given an integer x, return true if x is a palindrome, and false otherwise.

// Constraints:
// -2^31 <= x <= 2^31 - 1

//Code Structure:

/**
 * @param {number} x
 * @return {boolean}
 */
var isPalindrome = function(x) {
    const str = x.toString();
    const reversedStr = str.split('').reverse().join('');
    return str === reversedStr;
};
    