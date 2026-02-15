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
        for word in strs:
            sorted_word = ''.join(sorted(word))
            if sorted_word in anagram_groups:
                anagram_groups[sorted_word].append(word)
            else:
                anagram_groups[sorted_word] = [word]
        return list(anagram_groups.values())                                                                     
    