/** https://leetcode.com/problems/palindrome-number */
// Problem: Palindrome Number

//Problem Description:
//Given an integer x, return true if x is a palindrome, and false otherwise.

// Constraints:
// -2^31 <= x <= 2^31 - 1

//Code Structure:


class Solution {
    public boolean isPalindrome(int x) {
        // negative numbers are not palindrome
        if (x < 0) {
            return false;
        }
        
        int reversed = 0;
        int original = x;
        while (x > 0) {
            int pop = x % 10;
            x /= 10;
            reversed = reversed * 10 + pop;
        }
        
        return original == reversed;
    }
}
    