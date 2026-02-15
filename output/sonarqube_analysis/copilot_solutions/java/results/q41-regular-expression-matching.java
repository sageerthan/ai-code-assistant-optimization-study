/** https://leetcode.com/problems/regular-expression-matching */
// Problem: Regular Expression Matching

//Problem Description:
//Given an input string s and a pattern p, implement regular expression matching with support for '.' and '*' where:
//'.' Matches any single character.​​​​
//'*' Matches zero or more of the preceding element.
//The matching should cover the entire input string (not partial).

// Constraints:
// 1 <= s.length <= 20
// 1 <= p.length <= 20
// s contains only lowercase English letters.
// p contains only lowercase English letters, '.', and '*'.
// It is guaranteed for each appearance of the character '*', there will be a previous valid character to match.

//Code Structure:

class Solution {
      public boolean isMatch(String s, String p) {
        return isMatchHelper(s, p, 0, 0);
    }

    private boolean isMatchHelper(String s, String p, int i, int j) {
        if (j == p.length()) {
            return i == s.length();
        }

        boolean firstMatch = (i < s.length() && (s.charAt(i) == p.charAt(j) || p.charAt(j) == '.'));

        if (j + 1 < p.length() && p.charAt(j + 1) == '*') {
            return (isMatchHelper(s, p, i, j + 2) || (firstMatch && isMatchHelper(s, p, i + 1, j)));
        }

        return firstMatch && isMatchHelper(s, p, i + 1, j + 1);
    }
  
}
    