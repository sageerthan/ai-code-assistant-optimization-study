/** https://leetcode.com/problems/word-break */
// Problem: Word Break

//Problem Description:
//Given a string s and a dictionary of strings wordDict, return true if s can be segmented into a space-separated sequence of one or more dictionary words.
//Note that the same word in the dictionary may be reused multiple times in the segmentation.

// Constraints:
// 1 <= s.length <= 300
// 1 <= wordDict.length <= 1000
// 1 <= wordDict[i].length <= 20
// s and wordDict[i] consist of only lowercase English letters.
// All the strings of wordDict are unique.

//Code Structure:

class Solution {
    public boolean wordBreak(String s, List<String> wordDict) {
        // Create a boolean array to store the results
        boolean[] dp = new boolean[s.length() + 1];
        // Set the first element to true
        dp[0] = true;
        // Loop through each character in the string
        for (int i = 1; i <= s.length(); i++) {
            // Loop through each word in the dictionary
            for (int j = 0; j < i; j++) {
                // Check if the substring from j to i is in the dictionary and the substring from 0 to j is true
                if (dp[j] && wordDict.contains(s.substring(j, i))) {
                    // Set the current element to true
                    dp[i] = true;
                    // Break out of the inner loop
                    break;
                }
            }
        }
        // Return the last element of the boolean array
        return dp[s.length()];
    }
}
    