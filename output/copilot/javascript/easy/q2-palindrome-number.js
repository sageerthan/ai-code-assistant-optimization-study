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
    // If x is negative or ends with 0 (and is not 0), it cannot be a palindrome
    if (x < 0 || (x % 10 === 0 && x !== 0)) {
        return false;
    }

    let reversed = 0;
    let original = x;

    // Reverse the number
    while (x > 0) {
        reversed = reversed * 10 + (x % 10);
        x = Math.floor(x / 10);
    }

    // Check if the reversed number is equal to the original number
    return reversed === original;
};
    