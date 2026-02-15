/** https://leetcode.com/problems/longest-substring-without-repeating-characters */
// Problem: Longest Substring Without Repeating Characters

//Problem Description:
//Given a string s, find the length of the longest substring without duplicate characters.

// Constraints:
// 0 <= s.length <= 5 * 10^4
// s consists of English letters, digits, symbols and spaces.

//Code Structure:

import java.util.HashMap;
class Solution {
    public int lengthOfLongestSubstring(String s) {
        // Create a HashMap to store the characters and their indices
        HashMap<Character, Integer> map = new HashMap<>();
        int max = 0;
        int start = 0;
        // Loop through each character in the string
        for (int i = 0; i < s.length(); i++) {
            // If the character is already in the map
            if (map.containsKey(s.charAt(i))) {
                // Update the start index to the maximum of the current start index and the index of the character plus 1
                start = Math.max(start, map.get(s.charAt(i)) + 1);
            }
            // Update the maximum length of the substring
            max = Math.max(max, i - start + 1);
            // Add the character and its index to the map
            map.put(s.charAt(i), i);
        }
        return max;
    }
}
    