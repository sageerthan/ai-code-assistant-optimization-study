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

// First generated code

class Solution {
    public boolean isMatch(String s, String p) {
        int sIndex = 0, pIndex = 0, match = 0, starIndex = -1;
        char[] sc = s.toCharArray(), pc = p.toCharArray();
        while (sIndex < sc.length) {
            if (pc[pIndex] == sc[sIndex] || pc[pIndex] == '.') {
                pIndex++; sIndex++;
            } else if (pc[pIndex] == '*') {
                starIndex = pIndex;
                match = sIndex;
                pIndex++;
            } else if (starIndex != -1) {
                pIndex = starIndex + 1;
                match++;
                sIndex = match;
            } else return false;
        }
        while (pIndex < pc.length && pc[pIndex] == '*') pIndex++;
        return pIndex == pc.length;
    }
}


// Debugged Code

class Solution {
    public boolean isMatch(String s, String p) {
        int sIndex = 0, pIndex = 0, match = 0, starIndex = -1;
        char[] sc = s.toCharArray(), pc = p.toCharArray();
        while (sIndex < sc.length) {
            if (pIndex < pc.length && (pc[pIndex] == sc[sIndex] || pc[pIndex] == '.')) {
                sIndex++; pIndex++;
            } else if (pc[pIndex] == '*') {
                starIndex = pIndex;
                match = sIndex;
                pIndex++;
            } else if (starIndex != -1) {
                pIndex = starIndex + 1;
                match++;
                sIndex = match;
            } else {
                return false;
            }
        }
        while (pIndex < pc.length && pc[pIndex] == '*') pIndex++;
        return pIndex == pc.length;
    }
}