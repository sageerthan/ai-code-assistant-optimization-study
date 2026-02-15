/** https://leetcode.com/problems/valid-anagram */
// Problem: Valid Anagram

//Problem Description:
//Given two strings s and t, return true if t is an anagram of s, and false otherwise.

// Constraints:
// 1 <= s.length, t.length <= 5 * 10^4
// s and t consist of lowercase English letters.

//Code Structure:

class Solution {
    public boolean isAnagram(String s, String t) {
        // If lengths are not equal, they cannot be anagrams
        if (s.length() != t.length()) {
            return false;
        }

        // Create an array to count occurrences of each character
        int[] charCount = new int[26]; // Assuming only lowercase letters a-z

        // Count characters in the first string
        for (char c : s.toCharArray()) {
            charCount[c - 'a']++;
        }

        // Subtract counts using the second string
        for (char c : t.toCharArray()) {
            charCount[c - 'a']--;
            // If count goes negative, t has more of this character than s
            if (charCount[c - 'a'] < 0) {
                return false;
            }
        }

        // If all counts are zero, they are anagrams
        return true;    
    }
}
    