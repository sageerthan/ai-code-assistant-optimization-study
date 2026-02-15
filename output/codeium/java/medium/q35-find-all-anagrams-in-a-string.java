/** https://leetcode.com/problems/find-all-anagrams-in-a-string */
// Problem: Find All Anagrams in a String

//Problem Description:
//Given two strings s and p, return an array of all the start indices of p's anagrams in s. You may return the answer in any order.

// Constraints:
// 1 <= s.length, p.length <= 3 * 10^4
// s and p consist of lowercase English letters.

//Code Structure:
class Solution {
    public List<Integer> findAnagrams(String s, String p) {
        List<Integer> res = new ArrayList<>();
        if(s == null || p == null || s.length() == 0 || p.length() == 0) return res;
        
        int[] pCount = new int[26];
        for(char c : p.toCharArray()) pCount[c - 'a']++;
        
        int[] sCount = new int[26];
        int left = 0, right = 0, count = 0;
        while(right < s.length()) {
            if(pCount[s.charAt(right) - 'a'] == 0) {
                left = right + 1;
                count = 0;
                Arrays.fill(sCount, 0);
            } else {
                sCount[s.charAt(right) - 'a']++;
                if(sCount[s.charAt(right) - 'a'] <= pCount[s.charAt(right) - 'a']) count++;
                while(count == p.length()) {
                    if(right - left + 1 == p.length()) res.add(left);
                    if(sCount[s.charAt(left) - 'a'] <= pCount[s.charAt(left) - 'a']) count--;
                    sCount[s.charAt(left) - 'a']--;
                    left++;
                }
            }
            right++;
        }
        return res;
    }
}
    