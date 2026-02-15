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

// First generated code:

/**
 * @param {number} capacity
 */
var LFUCache = function(capacity) {
    this.capacity = capacity; // Set the capacity of the cache
    this.cache = new Map(); // Map to store key-value pairs
    this.freqMap = new Map(); // Map to store frequency of each key
    this.minFreq = 0; // Track the minimum frequency of keys
    
};

/** 
 * @param {number} key
 * @return {number}
 */
LFUCache.prototype.get = function(key) {
    if (!this.cache.has(key)) {
        return -1; // If the key does not exist, return -1
    }
    
    // Get the current value and frequency of the key
    const value = this.cache.get(key);
    const freq = this.freqMap.get(key);
    
    // Update the frequency map
    this.freqMap.set(key, freq + 1);
    
    // Remove the key from the current frequency list
    this.cache.delete(key);
    
    // Add the key to the new frequency list
    this.cache.set(key, value);
    
    // Update the minimum frequency if necessary
    if (this.minFreq === freq && !this.cache.has(freq + 1)) {
        this.minFreq++;
    }
    
    return value; // Return the value associated with the key   
};

/** 
 * @param {number} key 
 * @param {number} value
 * @return {void}
 */
LFUCache.prototype.put = function(key, value) {
    if (this.capacity <= 0) return; // If capacity is 0, do nothing
    
    if (this.cache.has(key)) {
        // If the key already exists, update its value and frequency
        this.cache.set(key, value);
        const freq = this.freqMap.get(key);
        this.freqMap.set(key, freq + 1);
        
        // Update the minimum frequency if necessary
        if (this.minFreq === freq && !this.cache.has(freq + 1)) {
            this.minFreq++;
        }
    } else {
        // If the key does not exist, check if we need to evict a key
        if (this.cache.size >= this.capacity) {
            // Evict the least frequently used key
            for (const [k, v] of this.cache.entries()) {
                if (this.freqMap.get(k) === this.minFreq) {
                    this.cache.delete(k);
                    this.freqMap.delete(k);
                    break;
                }
            }
        }
        
        // Add the new key-value pair with frequency 1
        this.cache.set(key, value);
        this.freqMap.set(key, 1);
        this.minFreq = 1; // Reset minimum frequency to 1
    }  
};

/** 
 * Your LFUCache object will be instantiated and called as such:
 * var obj = new LFUCache(capacity)
 * var param_1 = obj.get(key)
 * obj.put(key,value)
 */
    

// Debugged Code:

/**
 * @param {number} capacity
 */
var LFUCache = function(capacity) {
    this.capacity = capacity;
    this.size = 0;
    this.keyToVal = new Map(); // key -> value
    this.keyToFreq = new Map(); // key -> freq
    this.freqToKeys = new Map(); // freq -> ordered Set of keys
    this.minFreq = 0;
};

/** 
 * @param {number} key
 * @return {number}
 */
LFUCache.prototype.get = function(key) {
    if (!this.keyToVal.has(key)) return -1;
    // update frequency
    const freq = this.keyToFreq.get(key);
    this.keyToFreq.set(key, freq + 1);
    this.freqToKeys.get(freq).delete(key);
    if (!this.freqToKeys.has(freq + 1)) this.freqToKeys.set(freq + 1, new Set());
    this.freqToKeys.get(freq + 1).add(key);
    if (this.freqToKeys.get(freq).size === 0) {
        this.freqToKeys.delete(freq);
        if (this.minFreq === freq) this.minFreq++;
    }
    return this.keyToVal.get(key);
};

/** 
 * @param {number} key 
 * @param {number} value
 * @return {void}
 */
LFUCache.prototype.put = function(key, value) {
    if (this.capacity === 0) return;
    if (this.keyToVal.has(key)) {
        this.keyToVal.set(key, value);
        this.get(key); // update frequency
        return;
    }
    if (this.size === this.capacity) {
        // evict least frequently used and least recently used
        const keys = this.freqToKeys.get(this.minFreq);
        const lfuKey = keys.values().next().value;
        keys.delete(lfuKey);
        if (keys.size === 0) this.freqToKeys.delete(this.minFreq);
        this.keyToVal.delete(lfuKey);
        this.keyToFreq.delete(lfuKey);
        this.size--;
    }
    this.keyToVal.set(key, value);
    this.keyToFreq.set(key, 1);
    if (!this.freqToKeys.has(1)) this.freqToKeys.set(1, new Set());
    this.freqToKeys.get(1).add(key);
    this.minFreq = 1;
    this.size++;
};

/** 
 * Your LFUCache object will be instantiated and called as such:
 * var obj = new LFUCache(capacity)
 * var param_1 = obj.get(key)
 * obj.put(key,value)
 */
    