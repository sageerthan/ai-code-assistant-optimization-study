<?php
/** https://leetcode.com/problems/lru-cache */
// Problem: LRU Cache

//Problem Description:
//Design a data structure that follows the constraints of a Least Recently Used (LRU) cache.
//Implement the LRUCache class:
//LRUCache(int capacity) Initialize the LRU cache with positive size capacity.
//int get(int key) Return the value of the key if the key exists, otherwise return -1.
//void put(int key, int value) Update the value of the key if the key exists. Otherwise, add the key-value pair to the cache. If the number of keys exceeds the capacity from this operation, evict the least recently used key.
//The functions get and put must each run in O(1) average time complexity.

// Constraints:
// 1 <= capacity <= 3000
// 0 <= key <= 10^4
// 0 <= value <= 10^5
// At most 2 * 10^5 calls will be made to get and put.

//Code Structure:

// First generated code

// class LRUCache {

//     private $capacity;
//     private $keyToValue = array();
//     private $keyToCount = array();
//     private $countToLRUKeys = array();
//     private $minCount = 0;

//     /**
//      * @param Integer $capacity
//      */
//     function __construct($capacity) {
//         $this->capacity = $capacity;
//     }

//     /**
//      * @param Integer $key
//      * @return Integer
//      */
//     function get($key) {
//         if (isset($this->keyToValue[$key])) {
//             $count = $this->keyToCount[$key];
//             unset($this->countToLRUKeys[$count][$key]);
//             if (empty($this->countToLRUKeys[$count])) {
//                 unset($this->countToLRUKeys[$count]);
//             }

//             $this->keyToCount[$key] = $count + 1;
//             $this->countToLRUKeys[$count + 1][$key] = true;
//             $this->minCount = min(array_keys($this->countToLRUKeys));

//             return $this->keyToValue[$key];
//         }

//         return -1;
//     }

//     /**
//      * @param Integer $key
//      * @param Integer $value
//      * @return NULL
//      */
//     function put($key, $value) {
//         if ($this->capacity <= 0) {
//             return;
//         }

//         if (isset($this->keyToValue[$key])) {
//             $this->keyToValue[$key] = $value;
//             $this->get($key);
//             return;
//         }

//         if (count($this->keyToValue) >= $this->capacity) {
//             $lruKey = key($this->countToLRUKeys[$this->minCount]);
//             unset($this->keyToValue[$lruKey]);
//             unset($this->keyToCount[$lruKey]);
//             unset($this->countToLRUKeys[$this->minCount][$lruKey]);
//             if (empty($this->countToLRUKeys[$this->minCount])) {
//                 unset($this->countToLRUKeys[$this->minCount]);
//             }
//         }

//         $this->keyToValue[$key] = $value;
//         $this->keyToCount[$key] = 1;
//         $this->countToLRUKeys[1][$key] = true;
//         $this->minCount = 1;
//     }
// }

/**
 * Your LRUCache object will be instantiated and called as such:
 * $obj = LRUCache($capacity);
 * $ret_1 = $obj->get($key);
 * $obj->put($key, $value);
 */

// Debugged Code

class LRUCache {

    private $capacity;
    private $keyToValue = array();
    private $keyToCount = array();
    private $countToLRUKeys = array();
    private $minCount = 0;

    /**
     * @param Integer $capacity
     */
    function __construct($capacity) {
        $this->capacity = $capacity;
    }

    /**
     * @param Integer $key
     * @return Integer
     */
    function get($key) {
        if (!isset($this->keyToValue[$key])) {
            return -1;
        }
        $count = $this->keyToCount[$key];
        unset($this->countToLRUKeys[$count][$key]);
        if (empty($this->countToLRUKeys[$count])) {
            unset($this->countToLRUKeys[$count]);
            if ($count == $this->minCount) {
                $this->minCount++;
            }
        }
        if (!isset($this->countToLRUKeys[$count+1])) {
            $this->countToLRUKeys[$count+1] = array();
        }
        $this->countToLRUKeys[$count+1][$key] = true;
        return $this->keyToValue[$key];
    }

    /**
     * @param Integer $key
     * @param Integer $value
     * @return Void
     */
    function put($key, $value) {
        if ($this->capacity <= 0) {
            return;
        }
        if (isset($this->keyToValue[$key])) {
            $count = $this->keyToCount[$key];
            unset($this->countToLRUKeys[$count][$key]);
            if (empty($this->countToLRUKeys[$count])) {
                unset($this->countToLRUKeys[$count]);
                if ($count == $this->minCount) {
                    $this->minCount++;
                }
            }
        } else {
            if (count($this->keyToValue) >= $this->capacity) {
                $lruKey = reset($this->countToLRUKeys[$this->minCount]);
                unset($this->keyToValue[$lruKey]);
                unset($this->keyToCount[$lruKey]);
                unset($this->countToLRUKeys[$this->minCount][$lruKey]);
                if (empty($this->countToLRUKeys[$this->minCount])) {
                    unset($this->countToLRUKeys[$this->minCount]);
                    $this->minCount++;
                }
            }
        }
        $this->keyToValue[$key] = $value;
        $this->keyToCount[$key] = $this->minCount;
        $this->countToLRUKeys[$this->minCount][$key] = true;
    }
}
    