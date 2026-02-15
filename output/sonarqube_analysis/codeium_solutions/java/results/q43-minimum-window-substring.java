/** https://leetcode.com/problems/minimum-window-substring */
// Problem: Minimum Window Substring

//Problem Description:
//Given two strings s and t of lengths m and n respectively, return the minimum window substring of s such that every character in t (including duplicates) is included in the window. If there is no such substring, return the empty string "".
//The testcases will be generated such that the answer is unique.

// Constraints:
//m == s.length
// n == t.length
// 1 <= m, n <= 10^5
// s and t consist of uppercase and lowercase English letters.

//Code Structure:

class Solution {
    public String minWindow(String s, String t) {
        if (s == null || t == null || s.length() == 0 || t.length() == 0) {
            return "";
        }
        
        int[] map = new int[128];
        int left = 0, minLen = Integer.MAX_VALUE, minStart = 0;
        for (char c : t.toCharArray()) {
            map[c]++;
        }
        int count = t.length();
        for (int right = 0; right < s.length(); right++) {
            if (map[s.charAt(right)] > 0) {
                count--;
            }
            map[s.charAt(right)]--;
            while (count == 0) {
                if (right - left + 1 < minLen) {
                    minLen = right - left + 1;
                    minStart = left;
                }
                if (map[s.charAt(left)] == 0) {
                    count++;
                }
                map[s.charAt(left)]++;
                left++;
            }
        }
        return minLen == Integer.MAX_VALUE ? "" : s.substring(minStart, minStart + minLen);
    }
}
    