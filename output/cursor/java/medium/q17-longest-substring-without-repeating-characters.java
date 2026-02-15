/** https://leetcode.com/problems/longest-substring-without-repeating-characters */
// Problem: Longest Substring Without Repeating Characters

//Problem Description:
//Given a string s, find the length of the longest substring without duplicate characters.

// Constraints:
// 0 <= s.length <= 5 * 10^4
// s consists of English letters, digits, symbols and spaces.

//Code Structure:

class Solution {
    public int lengthOfLongestSubstring(String s) {
        int left = 0, right = 0;
        int maxLen = 0;
        Set<Character> seen = new HashSet<>();
        
        while (right < s.length()) {
            if (!seen.contains(s.charAt(right))) {
                seen.add(s.charAt(right));
                right++;
                maxLen = Math.max(maxLen, right - left);
            } else {
                seen.remove(s.charAt(left));
                left++;
            }
        }
        
        return maxLen;
    }
}
    