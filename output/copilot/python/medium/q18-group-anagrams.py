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
        anagrams = {}
        
        for s in strs:
            # Sort the string to create a key
            key = ''.join(sorted(s))
            if key not in anagrams:
                anagrams[key] = []
            anagrams[key].append(s)
        
        return list(anagrams.values())                                                                    
    