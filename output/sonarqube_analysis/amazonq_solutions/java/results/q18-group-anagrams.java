/** https://leetcode.com/problems/group-anagrams */
// Problem: Group Anagrams

//Problem Description:
//Given an array of strings strs, group the anagrams together. You can return the answer in any order.

// Constraints:
// 1 <= strs.length <= 10^4
// 0 <= strs[i].length <= 100
// strs[i] consists of lowercase English letters.

//Code Structure:

import java.util.Map;
import java.util.HashMap;
import java.util.ArrayList;
import java.util.Arrays;
class Solution {
    public List<List<String>> groupAnagrams(String[] strs) {
        // Create a map to store the anagrams
        Map<String, List<String>> map = new HashMap<>();
        // Loop through each string in the array
        for (String s : strs) {
            // Convert the string to a character array
            char[] c = s.toCharArray();
            // Sort the character array
            Arrays.sort(c);
            // Convert the sorted character array back to a string
            String key = String.valueOf(c);
            // If the key is not in the map, add it
            if (!map.containsKey(key)) {
                map.put(key, new ArrayList<>());
            }
            // Add the string to the list of anagrams
            map.get(key).add(s);
        }
        // Return the list of anagrams
        return new ArrayList<>(map.values());
    }
}
    