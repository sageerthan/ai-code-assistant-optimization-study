# https://leetcode.com/problems/group-anagrams/
# Problem: Group Anagrams

#Problem Description:
#Given an array of strings strs, group the anagrams together. You can return the answer in any order.

# Constraints:
# 1 <= strs.length <= 10^4
# 0 <= strs[i].length <= 100
# strs[i] consists of lowercase English letters.

#Code Structure:

class Solution(object):
    def groupAnagrams(self, strs):
        """
        :type strs: List[str]
        :rtype: List[List[str]]
        """
        anagram_groups = {}
        
        for s in strs:
            # Sort characters to create a key for anagrams
            key = ''.join(sorted(s))
            
            # Group strings with the same sorted key
            if key not in anagram_groups:
                anagram_groups[key] = []
            anagram_groups[key].append(s)
        
        # Return only the values (groups) without the keys
        return list(anagram_groups.values())
    