/** https://leetcode.com/problems/find-all-anagrams-in-a-string */
// Problem: Find All Anagrams in a String

//Problem Description:
//Given two strings s and p, return an array of all the start indices of p's anagrams in s. You may return the answer in any order.

// Constraints:
// 1 <= s.length, p.length <= 3 * 10^4
// s and p consist of lowercase English letters.

//Code Structure:

// First generated code:

/**
 * @param {string} s
 * @param {string} p
 * @return {number[]}
 */
var findAnagrams = function(s, p) {
    const result = [];
    const pLen = p.length;
    const sLen = s.length;
    
    if (pLen > sLen) return result;
    
    // Create frequency map for pattern p
    const pCount = {};
    for (let char of p) {
        pCount[char] = (pCount[char] || 0) + 1;
    }
    
    // Create frequency map for sliding window
    const windowCount = {};
    let left = 0;
    
    for (let right = 0; right < sLen; right++) {
        // Add character to window
        windowCount[s[right]] = (windowCount[s[right]] || 0) + 1;
        
        // If window size equals pattern length
        if (right - left + 1 === pLen) {
            // Check if frequencies match
            if (JSON.stringify(pCount) === JSON.stringify(windowCount)) {
                result.push(left);
            }
            
            // Remove leftmost character from window
            windowCount[s[left]]--;
            if (windowCount[s[left]] === 0) {
                delete windowCount[s[left]];
            }
            left++;
        }
    }
    
    return result;
};
  

// Debugged Code:
/**
 * Sliding window with fixed-size frequency arrays for O(26 * n).
 * @param {string} s
 * @param {string} p
 * @return {number[]}
 */
var findAnagrams = function (s, p) {
  const res = [];
  const m = p.length;
  const n = s.length;
  if (m > n) return res;

  const aCode = "a".charCodeAt(0);
  const need = new Array(26).fill(0);
  const window = new Array(26).fill(0);

  for (const ch of p) need[ch.charCodeAt(0) - aCode]++;

  // seed the first window
  for (let i = 0; i < m; i++) window[s.charCodeAt(i) - aCode]++;

  const matches = () => {
    for (let i = 0; i < 26; i++) if (need[i] !== window[i]) return false;
    return true;
  };

  if (matches()) res.push(0);

  for (let right = m; right < n; right++) {
    const addIdx = s.charCodeAt(right) - aCode;
    const removeIdx = s.charCodeAt(right - m) - aCode;
    window[addIdx]++;
    window[removeIdx]--;
    if (matches()) res.push(right - m + 1);
  }

  return res;
};