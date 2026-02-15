/** https://leetcode.com/problems/palindrome-number */
// Problem: Palindrome Number

//Problem Description:
//Given an integer x, return true if x is a palindrome, and false otherwise.

// Constraints:
// -2^31 <= x <= 2^31 - 1

//Code Structure:

class Solution {
    public boolean isPalindrome(int x) {
        // Negative numbers are not palindromes
        if (x < 0) {
            return false;
        }
        // Store the original number in a variable
        int original = x;
        // Store the reversed number in a variable
        int reversed = 0;
        // Loop through each digit in the number
        while (x != 0) {
            // Get the last digit of the number
            int digit = x % 10;
            // Add the digit to the reversed number
            reversed = reversed * 10 + digit;
            // Remove the last digit from the number
            x /= 10;
        }
        // Check if the original number is equal to the reversed number
        return original == reversed;

    }
}
    