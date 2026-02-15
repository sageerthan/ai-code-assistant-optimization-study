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

// First generated code
// class Solution {

//     /**
//      * @param String $beginWord
//      * @param String $endWord
//      * @param String[] $wordList
//      * @return Integer
//      */
//     function ladderLength($beginWord, $endWord, $wordList) {
//         $wordSet = new SplDoublyLinkedList($wordList);
//         if (!$wordSet->contains($endWord)) {
//             return 0;
//         }
//         $queue = new SplQueue();
//         $queue->enqueue([$beginWord, 1]);
//         while (!$queue->isEmpty()) {
//             list($word, $level) = $queue->dequeue();
//             if ($word === $endWord) {
//                 return $level;
//             }
//             for ($i = 0; $i < strlen($word); $i++) {
//                 for ($c = 'a'; $c <= 'z'; $c++) {
//                     $newWord = substr_replace($word, $c, $i, 1);
//                     if ($wordSet->contains($newWord)) {
//                         $queue->enqueue([$newWord, $level + 1]);
//                         $wordSet->detach($newWord);
//                     }
//                 }
//             }
//         }
//         return 0;
//     }
// }
    
// Debugged code

function ladderLength($beginWord, $endWord, $wordList) {
    $wordSet = $wordList;
    if (!in_array($endWord, $wordSet)) {
        return 0;
    }
    $queue = new SplQueue();
    $queue->enqueue([$beginWord, 1]);
    while (!$queue->isEmpty()) {
        list($word, $level) = $queue->dequeue();
        if ($word === $endWord) {
            return $level;
        }
        for ($i = 0; $i < strlen($word); $i++) {
            for ($c = 'a'; $c <= 'z'; $c++) {
                $newWord = substr_replace($word, $c, $i, 1);
                if (in_array($newWord, $wordSet)) {
                    $queue->enqueue([$newWord, $level + 1]);
                    $key = array_search($newWord, $wordSet);
                    unset($wordSet[$key]);
                }
            }
        }
    }
    return 0;
}