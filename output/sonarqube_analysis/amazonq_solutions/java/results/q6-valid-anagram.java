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
        // Check if the lengths of the strings are equal
        if (s.length() != t.length()) {
            return false;
        }
        // Create an array to store the frequency of each character
        int[] freq = new int[26];
        // Loop through each character in the strings
        for (int i = 0; i < s.length(); i++) {
            // Increment the frequency of the character in s
            freq[s.charAt(i) - 'a']++;
            // Decrement the frequency of the character in t
            freq[t.charAt(i) - 'a']--;
        }
        // Loop through each character in the array
        for (int i = 0; i < 26; i++) {
            // If the frequency of the character is not zero, return false
            if (freq[i] != 0) {
                return false;
            }
        }
        // If all characters have zero frequency, return true
        return true;
    }
}
    