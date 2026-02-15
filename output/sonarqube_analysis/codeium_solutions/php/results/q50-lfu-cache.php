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

class LFUCache {

    private $capacity;
    private $keyNode = [];
    private $countNode = [];
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
        if (!isset($this->keyNode[$key])) {
            return -1;
        }
        $count = $this->countNode[$key] + 1;
        $this->countNode[$key] = $count;
        if ($count === $this->minCount) {
            $this->minCount = $count + 1;
        }
        return $this->keyNode[$key];
    }
  
    /**
     * @param Integer $key
     * @param Integer $value
     * @return NULL
     */
    function put($key, $value) {
        if ($this->capacity <= 0) {
            return;
        }
        if (isset($this->keyNode[$key])) {
            $this->get($key);
            $this->keyNode[$key] = $value;
            return;
        }
        if (count($this->keyNode) >= $this->capacity) {
            ksort($this->countNode);
            $minCount = min($this->countNode);
            foreach ($this->countNode as $k => $v) {
                if ($v === $minCount) {
                    unset($this->keyNode[$k], $this->countNode[$k]);
                    break;
                }
            }
        }
        $this->keyNode[$key] = $value;
        $this->countNode[$key] = 1;
        $this->minCount = 1;
    }
}

/**
 * Your LFUCache object will be instantiated and called as such:
 * $obj = LFUCache($capacity);
 * $ret_1 = $obj->get($key);
 * $obj->put($key, $value);
 */
    