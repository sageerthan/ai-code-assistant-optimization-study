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
    public $val;
    public $prev;
    public $next;
    
    function __construct($key, $val) {
        $this->key = $key;
        $this->val = $val;
        $this->prev = null;
        $this->next = null;
    }
}

class LRUCache {
    private $capacity;
    private $map;
    private $head;
    private $tail;
    
    /**
     * @param Integer $capacity
     */
    function __construct($capacity) {
        $this->capacity = $capacity;
        $this->map = [];
        $this->head = new Node(0, 0);
        $this->tail = new Node(0, 0);
        $this->head->next = $this->tail;
        $this->tail->prev = $this->head;
    }
  
    /**
     * @param Integer $key
     * @return Integer
     */
    function get($key) {
        if (!isset($this->map[$key])) return -1;
        $node = $this->map[$key];
        $this->moveToHead($node);
        return $node->val;
    }
  
    /**
     * @param Integer $key
     * @param Integer $value
     * @return NULL
     */
    function put($key, $value) {
        if (isset($this->map[$key])) {
            $node = $this->map[$key];
            $node->val = $value;
            $this->moveToHead($node);
        } else {
            $newNode = new Node($key, $value);
            if (count($this->map) >= $this->capacity) {
                $last = $this->removeTail();
                unset($this->map[$last->key]);
            }
            $this->map[$key] = $newNode;
            $this->addToHead($newNode);
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
        $last = $this->tail->prev;
        $this->removeNode($last);
        return $last;
    }
}

/**
 * Your LRUCache object will be instantiated and called as such:
 * $obj = LRUCache($capacity);
 * $ret_1 = $obj->get($key);
 * $obj->put($key, $value);
 */
    