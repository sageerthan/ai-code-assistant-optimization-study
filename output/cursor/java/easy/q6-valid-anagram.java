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
        // Different lengths cannot be anagrams
        if (s.length() != t.length()) {
            return false;
        }
        
        // Array to count frequency of each character (a-z)
        int[] charCount = new int[26];
        
        // Count characters in string s
        for (char c : s.toCharArray()) {
            charCount[c - 'a']++;
        }
        
        // Decrease count for characters in string t
        for (char c : t.toCharArray()) {
            charCount[c - 'a']--;
        }
        
        // Check if all character counts are zero
        for (int count : charCount) {
            if (count != 0) {
                return false;
            }
        }
        
        return true;
    }
}
    