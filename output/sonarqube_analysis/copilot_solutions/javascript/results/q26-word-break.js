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
/**
 * @param {string} s
 * @param {string[]} wordDict
 * @return {boolean}
 */
var wordBreak = function(s, wordDict) {
    const wordSet = new Set(wordDict); // Convert wordDict to a set for O(1) lookups
    const dp = Array(s.length + 1).fill(false); // Create a DP array initialized to false
    dp[0] = true; // Base case: empty string can always be segmented

    // Iterate through the string s
    for (let i = 1; i <= s.length; i++) {
        // Check all possible previous positions j
        for (let j = 0; j < i; j++) {
            if (dp[j] && wordSet.has(s.substring(j, i))) {
                dp[i] = true; // If we can segment up to j and the substring from j to i is in the dictionary
                break; // No need to check further, we found a valid segmentation
            }
        }
    }
    return dp[s.length]; // Return whether the entire string can be segmented   
};
    