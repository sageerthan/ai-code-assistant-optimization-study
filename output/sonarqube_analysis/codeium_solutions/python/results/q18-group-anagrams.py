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
        from collections import defaultdict
        anagrams = defaultdict(list)
        for s in strs:
            anagrams["".join(sorted(s))].append(s)
        return list(anagrams.values())
    