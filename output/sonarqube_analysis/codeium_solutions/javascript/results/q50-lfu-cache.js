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
    constructor(key, value) {
        this.key = key;
        this.value = value;
        this.count = 1;
        this.prev = null;
        this.next = null;
    }
}

class DoublyLinkedList {
    constructor() {
        this.head = new Node(0, 0);
        this.tail = new Node(0, 0);
        this.head.next = this.tail;
        this.tail.prev = this.head;
        this.size = 0;
    }

    add(node) {
        node.prev = this.tail.prev;
        node.next = this.tail;
        this.tail.prev.next = node;
        this.tail.prev = node;
        this.size++;
    }

    remove(node) {
        node.prev.next = node.next;
        node.next.prev = node.prev;
        this.size--;
    }
}

/**
 * @param {number} capacity
 */
var LFUCache = function(capacity) {
    this.capacity = capacity;
    this.keyNode = {};
    this.countNode = {};
    this.minCount = 0;
};

/** 
 * @param {number} key
 * @return {number}
 */
LFUCache.prototype.get = function(key) {
    if (this.keyNode.hasOwnProperty(key)) {
        const node = this.keyNode[key];
        const count = node.count;
        this.countNode[count].remove(node);
        if (this.countNode[count].size === 0) {
            delete this.countNode[count];
            if (count === this.minCount) {
                this.minCount++;
            }
        }
        node.count++;
        this.countNode[node.count] = this.countNode[node.count] || new DoublyLinkedList();
        this.countNode[node.count].add(node);
        return node.value;
    }
    return -1;
};

/** 
 * @param {number} key 
 * @param {number} value
 * @return {void}
 */
LFUCache.prototype.put = function(key, value) {
    if (this.capacity <= 0) return;
    if (this.keyNode.hasOwnProperty(key)) {
        this.keyNode[key].value = value;
        this.get(key);
        return;
    }
    if (Object.keys(this.keyNode).length >= this.capacity) {
        const k = this.countNode[this.minCount].head.next.key;
        this.countNode[this.minCount].remove(this.keyNode[k]);
        delete this.keyNode[k];
        if (this.countNode[this.minCount].size === 0) {
            delete this.countNode[this.minCount];
            if (this.minCount === Object.keys(this.countNode)[0]) {
                this.minCount++;
            }
        }
    }
    this.keyNode[key] = new Node(key, value);
    this.countNode[1] = this.countNode[1] || new DoublyLinkedList();
    this.countNode[1].add(this.keyNode[key]);
    this.minCount = 1;
};

/** 
 * Your LFUCache object will be instantiated and called as such:
 * var obj = new LFUCache(capacity)
 * var param_1 = obj.get(key)
 * obj.put(key,value)
 */
    