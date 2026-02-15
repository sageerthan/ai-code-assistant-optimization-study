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
        
        // Convert the integer to a string
        String str = Integer.toString(x);
        
        // Check if the string is equal to its reverse
        String reversedStr = new StringBuilder(str).reverse().toString();
        
        return str.equals(reversedStr);       
    }
}
    