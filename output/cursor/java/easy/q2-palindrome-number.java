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
        
        // Numbers ending with 0 (except 0 itself) are not palindromes
        if (x != 0 && x % 10 == 0) {
            return false;
        }
        
        int reversed = 0;
        
        // Reverse only half of the number
        while (x > reversed) {
            reversed = reversed * 10 + x % 10;
            x /= 10;
        }
        
        // For even number of digits: x == reversed
        // For odd number of digits: x == reversed / 10 (middle digit doesn't matter)
        return x == reversed || x == reversed / 10;
    }
}
    