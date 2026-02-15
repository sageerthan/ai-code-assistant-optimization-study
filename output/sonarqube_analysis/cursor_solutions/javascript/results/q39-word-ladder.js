/** https://leetcode.com/problems/word-ladder */
// Problem: Word Ladder

//Problem Description:
//A transformation sequence from word beginWord to word endWord using a dictionary wordList is a sequence of words beginWord -> s1 -> s2 -> ... -> sk such that:
//Every adjacent pair of words differs by a single letter.
//Every si for 1 <= i <= k is in wordList. Note that beginWord does not need to be in wordList.
//sk == endWord
//Given two words, beginWord and endWord, and a dictionary wordList, return the number of words in the shortest transformation sequence from beginWord to endWord, or 0 if no such sequence exists.

// Constraints:
// 1 <= beginWord.length <= 10
// endWord.length == beginWord.length
// 1 <= wordList.length <= 5000
// wordList[i].length == beginWord.length
// beginWord, endWord, and wordList[i] consist of lowercase English letters.
// beginWord != endWord
// All the words in wordList are unique.

//Code Structure:
/**
 * @param {string} beginWord
 * @param {string} endWord
 * @param {string[]} wordList
 * @return {number}
 */
var ladderLength = function(beginWord, endWord, wordList) {
    const wordSet = new Set(wordList);
    
    if (!wordSet.has(endWord)) {
        return 0;
    }
    
    const queue = [beginWord];
    let level = 1;
    
    while (queue.length > 0) {
        const size = queue.length;
        
        for (let i = 0; i < size; i++) {
            const current = queue.shift();
            
            if (current === endWord) {
                return level;
            }
            
            // Generate all possible one-character variations
            const chars = current.split('');
            for (let j = 0; j < chars.length; j++) {
                const original = chars[j];
                
                for (let c = 97; c <= 122; c++) { // 'a' to 'z'
                    if (c === original.charCodeAt(0)) continue;
                    
                    chars[j] = String.fromCharCode(c);
                    const newWord = chars.join('');
                    
                    if (wordSet.has(newWord)) {
                        queue.push(newWord);
                        wordSet.delete(newWord); // Avoid revisiting
                    }
                }
                
                chars[j] = original; // Restore original character
            }
        }
        
        level++;
    }
    
    return 0; // No transformation sequence found
};
    