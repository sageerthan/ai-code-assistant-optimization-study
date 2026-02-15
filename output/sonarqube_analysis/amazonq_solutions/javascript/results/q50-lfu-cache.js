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
    constructor(key, val) {
        this.key = key;
        this.val = val;
        this.freq = 1;
        this.prev = null;
        this.next = null;
    }
}

class DLL {
    constructor() {
        this.head = new Node(0, 0);
        this.tail = new Node(0, 0);
        this.head.next = this.tail;
        this.tail.prev = this.head;
        this.size = 0;
    }
    
    add(node) {
        node.next = this.head.next;
        node.prev = this.head;
        this.head.next.prev = node;
        this.head.next = node;
        this.size++;
    }
    
    remove(node) {
        node.prev.next = node.next;
        node.next.prev = node.prev;
        this.size--;
    }
    
    removeLast() {
        const last = this.tail.prev;
        this.remove(last);
        return last;
    }
}

/**
 * @param {number} capacity
 */
var LFUCache = function(capacity) {
    this.capacity = capacity;
    this.minFreq = 0;
    this.keyToNode = new Map();
    this.freqToList = new Map();
};

/** 
 * @param {number} key
 * @return {number}
 */
LFUCache.prototype.get = function(key) {
    const node = this.keyToNode.get(key);
    if (!node) return -1;
    this.updateFreq(node);
    return node.val;
};

/** 
 * @param {number} key 
 * @param {number} value
 * @return {void}
 */
LFUCache.prototype.put = function(key, value) {
    if (this.capacity === 0) return;
    
    const node = this.keyToNode.get(key);
    if (node) {
        node.val = value;
        this.updateFreq(node);
    } else {
        if (this.keyToNode.size >= this.capacity) {
            const minFreqList = this.freqToList.get(this.minFreq);
            const toRemove = minFreqList.removeLast();
            this.keyToNode.delete(toRemove.key);
        }
        
        const newNode = new Node(key, value);
        this.keyToNode.set(key, newNode);
        if (!this.freqToList.has(1)) {
            this.freqToList.set(1, new DLL());
        }
        this.freqToList.get(1).add(newNode);
        this.minFreq = 1;
    }
};

LFUCache.prototype.updateFreq = function(node) {
    const oldFreq = node.freq;
    const oldList = this.freqToList.get(oldFreq);
    oldList.remove(node);
    
    if (oldFreq === this.minFreq && oldList.size === 0) {
        this.minFreq++;
    }
    
    node.freq++;
    if (!this.freqToList.has(node.freq)) {
        this.freqToList.set(node.freq, new DLL());
    }
    this.freqToList.get(node.freq).add(node);
};

/** 
 * Your LFUCache object will be instantiated and called as such:
 * var obj = new LFUCache(capacity)
 * var param_1 = obj.get(key)
 * obj.put(key,value)
 */
    