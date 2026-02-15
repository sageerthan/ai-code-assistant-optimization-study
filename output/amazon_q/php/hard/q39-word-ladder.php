<?php
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
class Solution {

    /**
     * @param String $beginWord
     * @param String $endWord
     * @param String[] $wordList
     * @return Integer
     */
    function ladderLength($beginWord, $endWord, $wordList) {
        $wordList = array_flip($wordList);
        if (!isset($wordList[$endWord])) {
            return 0;
        }
        $queue = new SplQueue();
        $queue->enqueue($beginWord);
        $level = 1;
        while (!$queue->isEmpty()) {
            $size = $queue->count();
            for ($i = 0; $i < $size; $i++) {
                $current = $queue->dequeue();
                if ($current == $endWord) {
                    return $level;
                }
                for ($j = 0; $j < strlen($current); $j++) {
                    for ($k = 0; $k < 26; $k++) {
                        $temp = $current;
                        $temp[$j] = chr(97 + $k);
                        if (isset($wordList[$temp])) {
                            unset($wordList[$temp]);
                            $queue->enqueue($temp);
                        }
                    }
                }
            }
            $level++;
        }
        return 0;
    }
}
    