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

/**
 * @param {number} capacity
 */
var LRUCache = function(capacity) {
    this.capacity = capacity; // Maximum number of items in the cache
    this.cache = new Map(); // Map to store key-value pairs
    this.order = []; // Array to maintain the order of keys for LRU
};

/** 
 * @param {number} key
 * @return {number}
 */
LRUCache.prototype.get = function(key) {
    if (!this.cache.has(key)) {
        return -1; // Key not found
    }
    // Move the key to the end to mark it as recently used
    this.order.splice(this.order.indexOf(key), 1);
    this.order.push(key);
    return this.cache.get(key); // Return the value associated with the key
};

/** 
 * @param {number} key 
 * @param {number} value
 * @return {void}
 */
LRUCache.prototype.put = function(key, value) {
    if (this.cache.has(key)) {
        // If the key already exists, update the value and mark it as recently used
        this.cache.set(key, value);
        this.order.splice(this.order.indexOf(key), 1);
    } else {
        // If the cache is at capacity, remove the least recently used item
        if (this.cache.size >= this.capacity) {
            const lruKey = this.order.shift(); // Remove the first key in order
            this.cache.delete(lruKey); // Remove it from the cache
        }
        this.cache.set(key, value); // Add the new key-value pair to the cache
    }
    this.order.push(key); // Mark the key as recently used
};

/** 
 * Your LRUCache object will be instantiated and called as such:
 * var obj = new LRUCache(capacity)
 * var param_1 = obj.get(key)
 * obj.put(key,value)
 */
    