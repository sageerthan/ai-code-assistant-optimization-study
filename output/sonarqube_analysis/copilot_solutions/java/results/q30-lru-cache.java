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

    public LRUCache(int capacity) {
        this.capacity = capacity;
        this.cache = new HashMap<>();
        this.lruList = new LinkedList<>();
    }
    
    public int get(int key) {
        if (cache.containsKey(key)) {
            // Move the accessed key to the front of the LRU list
            lruList.remove(key);
            lruList.addFirst(key);
            return cache.get(key);
        }
        return -1; // Key not found
    }
    
    public void put(int key, int value) {
        if (cache.containsKey(key)) {
            // Update the value and move the key to the front of the LRU list
            cache.put(key, value);
            lruList.remove(key);
            lruList.addFirst(key);
        } else {
            // Add a new key-value pair
            if (cache.size() >= capacity) {
                // Evict the least recently used key
                int lruKey = lruList.removeLast();
                cache.remove(lruKey);
            }
            cache.put(key, value);
            lruList.addFirst(key);
        }
    }
}

/**
 * Your LRUCache object will be instantiated and called as such:
 * LRUCache obj = new LRUCache(capacity);
 * int param_1 = obj.get(key);
 * obj.put(key,value);
 */
    