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

class LRUCache {
    private $capacity;
    private $cache; // associative array: key => [value, node]
    private $head;  // dummy head of doubly linked list
    private $tail;  // dummy tail of doubly linked list

    /**
     * Doubly linked list node for O(1) LRU operations.
     */
    private function createNode($key = null, $value = null) {
        return ['key' => $key, 'value' => $value, 'prev' => null, 'next' => null];
    }

    /**
     * @param Integer $capacity
     */
    function __construct($capacity) {
        $this->capacity = $capacity;
        $this->cache = [];
        // Dummy head and tail nodes for easy removal/insertion
        $this->head = $this->createNode();
        $this->tail = $this->createNode();
        $this->head['next'] = &$this->tail;
        $this->tail['prev'] = &$this->head;
    }

    /**
     * Remove a node from the doubly linked list.
     */
    private function removeNode(&$node) {
        $prev = &$node['prev'];
        $next = &$node['next'];
        $prev['next'] = &$next;
        $next['prev'] = &$prev;
    }

    /**
     * Add a node right after head (most recently used).
     */
    private function addToHead(&$node) {
        $node['next'] = &$this->head['next'];
        $node['prev'] = &$this->head;
        $this->head['next']['prev'] = &$node;
        $this->head['next'] = &$node;
    }

    /**
     * @param Integer $key
     * @return Integer
     */
    function get($key) {
        if (!isset($this->cache[$key])) {
            return -1;
        }
        // Move node to head (most recently used)
        $node = &$this->cache[$key];
        $this->removeNode($node);
        $this->addToHead($node);
        return $node['value'];
    }

    /**
     * @param Integer $key
     * @param Integer $value
     * @return NULL
     */
    function put($key, $value) {
        if (isset($this->cache[$key])) {
            // Update value and move to head
            $node = &$this->cache[$key];
            $node['value'] = $value;
            $this->removeNode($node);
            $this->addToHead($node);
        } else {
            // New node
            $node = $this->createNode($key, $value);
            $this->cache[$key] = &$node;
            $this->addToHead($node);
            if (count($this->cache) > $this->capacity) {
                // Remove least recently used node (before tail)
                $lru = &$this->tail['prev'];
                $this->removeNode($lru);
                unset($this->cache[$lru['key']]);
            }
        }
    }
}

/**
 * Your LRUCache object will be instantiated and called as such:
 * $obj = LRUCache($capacity);
 * $ret_1 = $obj->get($key);
 * $obj->put($key, $value);
 */
 
 
