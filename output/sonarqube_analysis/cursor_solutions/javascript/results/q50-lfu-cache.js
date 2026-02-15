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

/**
 * @param {number} capacity
 */
var LFUCache = function(capacity) {
    this.capacity = capacity;
    this.minFreq = 0;
    this.keyToValue = new Map();
    this.keyToFreq = new Map();
    this.freqToKeys = new Map();
};

/** 
 * @param {number} key
 * @return {number}
 */
LFUCache.prototype.get = function(key) {
    if (!this.keyToValue.has(key)) {
        return -1;
    }
    
    // Update frequency
    this.updateFrequency(key);
    return this.keyToValue.get(key);
};

/** 
 * @param {number} key 
 * @param {number} value
 * @return {void}
 */
LFUCache.prototype.put = function(key, value) {
    if (this.capacity <= 0) {
        return;
    }
    
    if (this.keyToValue.has(key)) {
        // Update existing key
        this.keyToValue.set(key, value);
        this.updateFrequency(key);
    } else {
        // Insert new key
        if (this.keyToValue.size >= this.capacity) {
            this.evictLFU();
        }
        
        this.keyToValue.set(key, value);
        this.keyToFreq.set(key, 1);
        
        if (!this.freqToKeys.has(1)) {
            this.freqToKeys.set(1, new Set());
        }
        this.freqToKeys.get(1).add(key);
        this.minFreq = 1;
    }
};

LFUCache.prototype.updateFrequency = function(key) {
    const freq = this.keyToFreq.get(key);
    
    // Remove from current frequency list
    this.freqToKeys.get(freq).delete(key);
    if (this.freqToKeys.get(freq).size === 0) {
        this.freqToKeys.delete(freq);
        if (this.minFreq === freq) {
            this.minFreq++;
        }
    }
    
    // Add to new frequency list
    const newFreq = freq + 1;
    this.keyToFreq.set(key, newFreq);
    
    if (!this.freqToKeys.has(newFreq)) {
        this.freqToKeys.set(newFreq, new Set());
    }
    this.freqToKeys.get(newFreq).add(key);
};

LFUCache.prototype.evictLFU = function() {
    const minFreqKeys = this.freqToKeys.get(this.minFreq);
    const keyToEvict = minFreqKeys.values().next().value;
    
    minFreqKeys.delete(keyToEvict);
    if (minFreqKeys.size === 0) {
        this.freqToKeys.delete(this.minFreq);
    }
    
    this.keyToValue.delete(keyToEvict);
    this.keyToFreq.delete(keyToEvict);
};

/** 
 * Your LFUCache object will be instantiated and called as such:
 * var obj = new LFUCache(capacity)
 * var param_1 = obj.get(key)
 * obj.put(key,value)
 */
    