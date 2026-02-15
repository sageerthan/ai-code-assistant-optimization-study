<?php
/** https://leetcode.com/problems/lfu-cache */
// Problem: LFU Cache

//Problem Description:
//Design and implement a data structure for a Least Frequently Used (LFU) cache.
//Implement the LFUCache class:
//LFUCache(int capacity) Initializes the object with the capacity of the data structure.
//int get(int key) Gets the value of the key if the key exists in the cache. Otherwise, returns -1.
//void put(int key, int value) Update the value of the key if present, or inserts the key if not already present. When the cache reaches its capacity, it should invalidate and remove the least frequently used key before inserting a new item. For this problem, when there is a tie (i.e., two or more keys with the same frequency), the least recently used key would be invalidated.
//To determine the least frequently used key, a use counter is maintained for each key in the cache. The key with the smallest use counter is the least frequently used key.
//When a key is first inserted into the cache, its use counter is set to 1 (due to the put operation). The use counter for a key in the cache is incremented either a get or put operation is called on it.
//The functions get and put must each run in O(1) average time complexity.

// Constraints:

// 1 <= capacity <= 10^4
// 0 <= key <= 10^5
// 0 <= value <= 10^9
// At most 2 * 10^5 calls will be made to get and put.

//Code Structure:

// class LFUCache {
//     private $capacity;
//     private $minFreq;
//     private $keyToVal;    // key => value
//     private $keyToFreq;   // key => freq
//     private $freqToKeys;  // freq => ordered list of keys (SplDoublyLinkedList for LRU order)

//     /**
//      * @param Integer $capacity
//      */
//     function __construct($capacity) {
//         $this->capacity = $capacity;
//         $this->minFreq = 0;
//         $this->keyToVal = [];
//         $this->keyToFreq = [];
//         $this->freqToKeys = [];
//     }

//     /**
//      * @param Integer $key
//      * @return Integer
//      */
//     function get($key) {
//         if (!isset($this->keyToVal[$key])) {
//             return -1;
//         }
//         $this->increaseFreq($key);
//         return $this->keyToVal[$key];
//     }

//     /**
//      * @param Integer $key
//      * @param Integer $value
//      * @return NULL
//      */
//     function put($key, $value) {
//         if ($this->capacity == 0) return;

//         if (isset($this->keyToVal[$key])) {
//             $this->keyToVal[$key] = $value;
//             $this->increaseFreq($key);
//             return;
//         }

//         if (count($this->keyToVal) >= $this->capacity) {
//             // Evict the least frequently used and least recently used key
//             $minFreqKeys = $this->freqToKeys[$this->minFreq];
//             $evictKey = array_shift($minFreqKeys);
//             unset($this->keyToVal[$evictKey]);
//             unset($this->keyToFreq[$evictKey]);
//             $this->freqToKeys[$this->minFreq] = $minFreqKeys;
//             if (empty($this->freqToKeys[$this->minFreq])) 
//                 unset($this->freqToKeys[$this->minFreq]);
//             }
//         }

//         // Insert new key
//         $this->keyToVal[$key] = $value;
//         $this->keyToFreq[$key] = 1;
//         if (!isset($this->freqToKeys[1])) {
//             $this->freqToKeys[1] = [];
//         }
//         $this->freqToKeys[1][] = $key;
//         $this->minFreq = 1;
//     }

//     // Helper to increase frequency and maintain LRU order
//     private function increaseFreq($key) {
//         $freq = $this->keyToFreq[$key];
//         // Remove key from current freq list
//         $idx = array_search($key, $this->freqToKeys[$freq]);
//         array_splice($this->freqToKeys[$freq], $idx, 1);
//         if (empty($this->freqToKeys[$freq])) {
//             unset($this->freqToKeys[$freq]);
//             if ($this->minFreq == $freq) {
//                  $this->minFreq++;
//             }
//         }
//         // Add key to next freq list
//         $this->keyToFreq[$key] = $freq + 1;
//         if (!isset($this->freqToKeys[$freq + 1])) {
//             $this->freqToKeys[$freq + 1] = [];
//         }
//         $this->freqToKeys[$freq + 1][] = $key;
//     }
// }

/**
 * Your LFUCache object will be instantiated and called as such:
 * $obj = LFUCache($capacity);
 * $ret_1 = $obj->get($key);
 * $obj->put($key, $value);
 */

// Debugged Code:

class LFUCache {
    private $capacity;
    private $minFreq;
    private $keyToVal;    // key => value
    private $keyToFreq;   // key => freq
    private $freqToKeys;  // freq => ordered list of keys (SplDoublyLinkedList for LRU order)

    /**
     * @param Integer $capacity
     */
    function __construct($capacity) {
        $this->capacity = $capacity;
        $this->minFreq = 0;
        $this->keyToVal = [];
        $this->keyToFreq = [];
        $this->freqToKeys = [];
    }

    /**
     * @param Integer $key
     * @return Integer
     */
    function get($key) {
        if (!isset($this->keyToVal[$key])) {
            return -1;
        }
        $this->increaseFreq($key);
        return $this->keyToVal[$key];
    }

    /**
     * @param Integer $key
     * @param Integer $value
     * @return NULL
     */
    function put($key, $value) {
        if ($this->capacity == 0) return;

        if (isset($this->keyToVal[$key])) {
            $this->keyToVal[$key] = $value;
            $this->increaseFreq($key);
            return;
        }

        if (count($this->keyToVal) >= $this->capacity) {
            // Evict the least frequently used and least recently used key
            $minFreqKeys = $this->freqToKeys[$this->minFreq];
            $evictKey = array_shift($minFreqKeys);
            unset($this->keyToVal[$evictKey]);
            unset($this->keyToFreq[$evictKey]);
            $this->freqToKeys[$this->minFreq] = $minFreqKeys;
            if (empty($this->freqToKeys[$this->minFreq])) {
                unset($this->freqToKeys[$this->minFreq]);
            }
        }

        // Insert new key
        $this->keyToVal[$key] = $value;
        $this->keyToFreq[$key] = 1;
        if (!isset($this->freqToKeys[1])) {
            $this->freqToKeys[1] = [];
        }
        $this->freqToKeys[1][] = $key;
        $this->minFreq = 1;
    }

    // Helper to increase frequency and maintain LRU order
    private function increaseFreq($key) {
        $freq = $this->keyToFreq[$key];
        // Remove key from current freq list
        $idx = array_search($key, $this->freqToKeys[$freq]);
        array_splice($this->freqToKeys[$freq], $idx, 1);
        if (empty($this->freqToKeys[$freq])) {
            unset($this->freqToKeys[$freq]);
            if ($this->minFreq == $freq) {
                 $this->minFreq++;
            }
        }
        // Add key to next freq list
        $this->keyToFreq[$key] = $freq + 1;
        if (!isset($this->freqToKeys[$freq + 1])) {
            $this->freqToKeys[$freq + 1] = [];
        }
        $this->freqToKeys[$freq + 1][] = $key;
    }
}

/**
 * Your LFUCache object will be instantiated and called as such:
 * $obj = LFUCache($capacity);
 * $ret_1 = $obj->get($key);
 * $obj->put($key, $value);
 */
    
    