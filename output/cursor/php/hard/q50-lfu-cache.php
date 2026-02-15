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
    private $keyToNode;
    private $freqToNodes;
    private $minFreq;
    
    /**
     * @param Integer $capacity
     */
    function __construct($capacity) {
        $this->capacity = $capacity;
        $this->keyToNode = [];
        $this->freqToNodes = [];
        $this->minFreq = 0;
    }
  
    /**
     * @param Integer $key
     * @return Integer
     */
    function get($key) {
        if (!isset($this->keyToNode[$key])) {
            return -1;
        }
        
        $node = $this->keyToNode[$key];
        $this->updateFrequency($node);
        return $node->value;
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
        
        if (isset($this->keyToNode[$key])) {
            // Update existing key
            $node = $this->keyToNode[$key];
            $node->value = $value;
            $this->updateFrequency($node);
        } else {
            // Add new key
            if (count($this->keyToNode) >= $this->capacity) {
                $this->evict();
            }
            
            $node = new Node($key, $value, 1);
            $this->keyToNode[$key] = $node;
            $this->addToFrequencyList($node, 1);
            $this->minFreq = 1;
        }
    }
    
    private function updateFrequency($node) {
        $oldFreq = $node->freq;
        $node->freq++;
        
        $this->removeFromFrequencyList($node, $oldFreq);
        $this->addToFrequencyList($node, $node->freq);
        
        if ($oldFreq === $this->minFreq && !isset($this->freqToNodes[$oldFreq])) {
            $this->minFreq = $node->freq;
        }
    }
    
    private function addToFrequencyList($node, $freq) {
        if (!isset($this->freqToNodes[$freq])) {
            $this->freqToNodes[$freq] = new DoublyLinkedList();
        }
        $this->freqToNodes[$freq]->addToHead($node);
    }
    
    private function removeFromFrequencyList($node, $freq) {
        if (isset($this->freqToNodes[$freq])) {
            $this->freqToNodes[$freq]->remove($node);
            if ($this->freqToNodes[$freq]->isEmpty()) {
                unset($this->freqToNodes[$freq]);
            }
        }
    }
    
    private function evict() {
        if (!isset($this->freqToNodes[$this->minFreq])) {
            return;
        }
        
        $lruList = $this->freqToNodes[$this->minFreq];
        $nodeToRemove = $lruList->removeTail();
        
        if ($nodeToRemove) {
            unset($this->keyToNode[$nodeToRemove->key]);
        }
    }
}

class Node {
    public $key;
    public $value;
    public $freq;
    public $prev;
    public $next;
    
    public function __construct($key, $value, $freq) {
        $this->key = $key;
        $this->value = $value;
        $this->freq = $freq;
        $this->prev = null;
        $this->next = null;
    }
}

class DoublyLinkedList {
    public $head;
    public $tail;
    
    public function __construct() {
        $this->head = new Node(0, 0, 0);
        $this->tail = new Node(0, 0, 0);
        $this->head->next = $this->tail;
        $this->tail->prev = $this->head;
    }
    
    public function addToHead($node) {
        $node->prev = $this->head;
        $node->next = $this->head->next;
        $this->head->next->prev = $node;
        $this->head->next = $node;
    }
    
    public function remove($node) {
        $node->prev->next = $node->next;
        $node->next->prev = $node->prev;
    }
    
    public function removeTail() {
        if ($this->isEmpty()) {
            return null;
        }
        
        $lastNode = $this->tail->prev;
        $this->remove($lastNode);
        return $lastNode;
    }
    
    public function isEmpty() {
        return $this->head->next === $this->tail;
    }
}

/**
 * Your LFUCache object will be instantiated and called as such:
 * $obj = LFUCache($capacity);
 * $ret_1 = $obj->get($key);
 * $obj->put($key, $value);
 */
    