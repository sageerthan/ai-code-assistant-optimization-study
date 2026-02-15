/** https://leetcode.com/problems/group-anagrams */
// Problem: Group Anagrams

//Problem Description:
//Given an array of strings strs, group the anagrams together. You can return the answer in any order.

// Constraints:
// 1 <= strs.length <= 10^4
// 0 <= strs[i].length <= 100
// strs[i] consists of lowercase English letters.

//Code Structure:

/**
 * @param {string[]} strs
 * @return {string[][]}
 */
var groupAnagrams = function(strs) {
    const anagramMap = new Map(); // Map to store sorted string as key and list of anagrams as value

    for (const str of strs) {
        const sortedStr = str.split('').sort().join(''); // Sort the characters in the string
        if (!anagramMap.has(sortedStr)) {
            anagramMap.set(sortedStr, []); // Initialize an empty array for this sorted string
        }
        anagramMap.get(sortedStr).push(str); // Add the original string to the corresponding anagram group
    }

    return Array.from(anagramMap.values()); // Return the grouped anagrams as an array of arrays 
};
    