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
    const wordSet = new Set(wordList); // Convert wordList to a set for O(1) lookups
    if (!wordSet.has(endWord)) return 0; // If endWord is not in the list, return 0

    let queue = [[beginWord, 1]]; // Initialize queue with the beginWord and step count
    while (queue.length > 0) {
        const [currentWord, steps] = queue.shift(); // Dequeue the front element

        if (currentWord === endWord) return steps; // If we reached the endWord, return the steps

        for (let i = 0; i < currentWord.length; i++) {
            for (let char = 'a'.charCodeAt(0); char <= 'z'.charCodeAt(0); char++) {
                const newChar = String.fromCharCode(char);
                const newWord = currentWord.slice(0, i) + newChar + currentWord.slice(i + 1);

                if (wordSet.has(newWord)) {
                    wordSet.delete(newWord); // Remove to prevent cycles
                    queue.push([newWord, steps + 1]); // Enqueue the new word with incremented step count
                }
            }
        }
    }

    return 0; // If no transformation sequence found, return 0
    
};
    