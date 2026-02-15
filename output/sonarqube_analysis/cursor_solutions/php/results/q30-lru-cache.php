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

class Node {
    public $key;
    public $value;
    public $prev;
    public $next;
    
    function __construct($key = 0, $value = 0) {
        $this->key = $key;
        $this->value = $value;
        $this->prev = null;
        $this->next = null;
    }
}

class LRUCache {
    private $capacity;
    private $cache;
    private $head;
    private $tail;
    
    /**
     * @param Integer $capacity
     */
    function __construct($capacity) {
        $this->capacity = $capacity;
        $this->cache = [];
        
        // Create dummy head and tail nodes
        $this->head = new Node();
        $this->tail = new Node();
        $this->head->next = $this->tail;
        $this->tail->prev = $this->head;
    }
  
    /**
     * @param Integer $key
     * @return Integer
     */
    function get($key) {
        if (!isset($this->cache[$key])) {
            return -1;
        }
        
        $node = $this->cache[$key];
        $this->moveToHead($node);
        return $node->value;
    }
  
    /**
     * @param Integer $key
     * @param Integer $value
     * @return NULL
     */
    function put($key, $value) {
        if (isset($this->cache[$key])) {
            // Update existing node
            $node = $this->cache[$key];
            $node->value = $value;
            $this->moveToHead($node);
        } else {
            // Add new node
            $node = new Node($key, $value);
            
            if (count($this->cache) >= $this->capacity) {
                // Remove least recently used
                $tail = $this->removeTail();
                unset($this->cache[$tail->key]);
            }
            
            $this->cache[$key] = $node;
            $this->addToHead($node);
        }
    }
    
    private function addToHead($node) {
        $node->prev = $this->head;
        $node->next = $this->head->next;
        $this->head->next->prev = $node;
        $this->head->next = $node;
    }
    
    private function removeNode($node) {
        $node->prev->next = $node->next;
        $node->next->prev = $node->prev;
    }
    
    private function moveToHead($node) {
        $this->removeNode($node);
        $this->addToHead($node);
    }
    
    private function removeTail() {
        $lastNode = $this->tail->prev;
        $this->removeNode($lastNode);
        return $lastNode;
    }
}

/**
 * Your LRUCache object will be instantiated and called as such:
 * $obj = LRUCache($capacity);
 * $ret_1 = $obj->get($key);
 * $obj->put($key, $value);
 */
    