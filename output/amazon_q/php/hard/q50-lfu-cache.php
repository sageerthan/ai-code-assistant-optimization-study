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

class Node {
    public $key;
    public $val;
    public $freq;
    public $prev;
    public $next;
    
    function __construct($key, $val) {
        $this->key = $key;
        $this->val = $val;
        $this->freq = 1;
        $this->prev = null;
        $this->next = null;
    }
}

class DLL {
    public $head;
    public $tail;
    public $size;
    
    function __construct() {
        $this->head = new Node(0, 0);
        $this->tail = new Node(0, 0);
        $this->head->next = $this->tail;
        $this->tail->prev = $this->head;
        $this->size = 0;
    }
    
    function add($node) {
        $node->next = $this->head->next;
        $node->prev = $this->head;
        $this->head->next->prev = $node;
        $this->head->next = $node;
        $this->size++;
    }
    
    function remove($node) {
        $node->prev->next = $node->next;
        $node->next->prev = $node->prev;
        $this->size--;
    }
    
    function removeLast() {
        $last = $this->tail->prev;
        $this->remove($last);
        return $last;
    }
}

class LFUCache {
    private $capacity;
    private $minFreq;
    private $keyToNode;
    private $freqToList;
    
    /**
     * @param Integer $capacity
     */
    function __construct($capacity) {
        $this->capacity = $capacity;
        $this->minFreq = 0;
        $this->keyToNode = [];
        $this->freqToList = [];
    }
  
    /**
     * @param Integer $key
     * @return Integer
     */
    function get($key) {
        if (!isset($this->keyToNode[$key])) return -1;
        $node = $this->keyToNode[$key];
        $this->updateFreq($node);
        return $node->val;
    }
  
    /**
     * @param Integer $key
     * @param Integer $value
     * @return NULL
     */
    function put($key, $value) {
        if ($this->capacity == 0) return;
        
        if (isset($this->keyToNode[$key])) {
            $node = $this->keyToNode[$key];
            $node->val = $value;
            $this->updateFreq($node);
        } else {
            if (count($this->keyToNode) >= $this->capacity) {
                $minFreqList = $this->freqToList[$this->minFreq];
                $toRemove = $minFreqList->removeLast();
                unset($this->keyToNode[$toRemove->key]);
            }
            
            $newNode = new Node($key, $value);
            $this->keyToNode[$key] = $newNode;
            if (!isset($this->freqToList[1])) {
                $this->freqToList[1] = new DLL();
            }
            $this->freqToList[1]->add($newNode);
            $this->minFreq = 1;
        }
    }
    
    private function updateFreq($node) {
        $oldFreq = $node->freq;
        $oldList = $this->freqToList[$oldFreq];
        $oldList->remove($node);
        
        if ($oldFreq == $this->minFreq && $oldList->size == 0) {
            $this->minFreq++;
        }
        
        $node->freq++;
        if (!isset($this->freqToList[$node->freq])) {
            $this->freqToList[$node->freq] = new DLL();
        }
        $this->freqToList[$node->freq]->add($node);
    }
}

/**
 * Your LFUCache object will be instantiated and called as such:
 * $obj = LFUCache($capacity);
 * $ret_1 = $obj->get($key);
 * $obj->put($key, $value);
 */
    