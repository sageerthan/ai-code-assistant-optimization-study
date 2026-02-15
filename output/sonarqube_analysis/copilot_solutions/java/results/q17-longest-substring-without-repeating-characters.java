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
        int n = s.length();
        if (n == 0) return 0;

        Map<Character, Integer> charIndexMap = new HashMap<>();
        int maxLength = 0;
        int start = 0; // Start index of the current substring

        for (int end = 0; end < n; end++) {
            char currentChar = s.charAt(end);

            // If the character is already in the map and its index is within the current substring
            if (charIndexMap.containsKey(currentChar) && charIndexMap.get(currentChar) >= start) {
                // Move the start index to the right of the last occurrence of the current character
                start = charIndexMap.get(currentChar) + 1;
            }

            // Update the last occurrence of the current character
            charIndexMap.put(currentChar, end);
            // Calculate the length of the current substring
            maxLength = Math.max(maxLength, end - start + 1);
        }
        return maxLength; // Return the maximum length found
    }
}
    