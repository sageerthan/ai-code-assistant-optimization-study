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

class LFUCache {

    public LFUCache(int capacity) {
        // Initialize the cache with the given capacity
        // Use a HashMap to store key-value pairs and another HashMap to store frequency counts
        // Use a priority queue or a linked list to maintain the order of least frequently used keys
        // Implement methods for get and put operations
        // Initialize data structures here
        // Example:
        this.capacity = capacity;
        this.minFreq = 0;
        this.keyMap = new HashMap<>();
        this.freqMap = new HashMap<>();
    }
    
    public int get(int key) {
        if (!keyMap.containsKey(key)) {
            return -1;
        }
        // Update the frequency of the key
        int freq = keyMap.get(key).freq;
        keyMap.get(key).freq++;
        freqMap.get(freq).remove(key);
        if (freqMap.get(freq).isEmpty()) {
            freqMap.remove(freq);
            if (minFreq == freq) {
                minFreq++;
            }
        }
        freqMap.putIfAbsent(freq + 1, new LinkedHashSet<>());
        freqMap.get(freq + 1).add(key);
        return keyMap.get(key).value;
    }
    
    public void put(int key, int value) {
        if (capacity == 0) return;

        if (keyMap.containsKey(key)) {
            // Update the value and frequency
            keyMap.get(key).value = value;
            get(key); // This will update the frequency
        } else {
            if (keyMap.size() >= capacity) {
                // Evict the least frequently used key
                evict();
            }
            // Insert the new key
            keyMap.put(key, new Node(key, value));
            freqMap.putIfAbsent(1, new LinkedHashSet<>());
            freqMap.get(1).add(key);
            minFreq = 1;
        }
    }

    private void evict() {
        // Find the least frequently used key
        LinkedHashSet<Integer> minFreqKeys = freqMap.get(minFreq);
        if (minFreqKeys != null && !minFreqKeys.isEmpty()) {
            int lfuKey = minFreqKeys.iterator().next();
            minFreqKeys.remove(lfuKey);
            if (minFreqKeys.isEmpty()) {
                freqMap.remove(minFreq);
            }
            keyMap.remove(lfuKey);
        }
    }
}

/**
 * Your LFUCache object will be instantiated and called as such:
 * LFUCache obj = new LFUCache(capacity);
 * int param_1 = obj.get(key);
 * obj.put(key,value);
 */

// Debugged Code:

import java.util.HashMap;
import java.util.LinkedHashSet;

class Node {
    int key;
    int value;
    int freq;
    
    Node(int key, int value) {
        this.key = key;
        this.value = value;
        this.freq = 1;
    }
}

class LFUCache {
    private int capacity;
    private int minFreq;
    private HashMap<Integer, Node> keyMap;
    private HashMap<Integer, LinkedHashSet<Integer>> freqMap;

    public LFUCache(int capacity) {
        // Initialize the cache with the given capacity
        // Use a HashMap to store key-value pairs and another HashMap to store frequency counts
        // Use a priority queue or a linked list to maintain the order of least frequently used keys
        // Implement methods for get and put operations
        // Initialize data structures here
        // Example:
        this.capacity = capacity;
        this.minFreq = 0;
        this.keyMap = new HashMap<>();
        this.freqMap = new HashMap<>();
    }
    
    public int get(int key) {
        if (!keyMap.containsKey(key)) {
            return -1;
        }
        // Update the frequency of the key
        int freq = keyMap.get(key).freq;
        keyMap.get(key).freq++;
        freqMap.get(freq).remove(key);
        if (freqMap.get(freq).isEmpty()) {
            freqMap.remove(freq);
            if (minFreq == freq) {
                minFreq++;
            }
        }
        freqMap.putIfAbsent(freq + 1, new LinkedHashSet<>());
        freqMap.get(freq + 1).add(key);
        return keyMap.get(key).value;
    }
    
    public void put(int key, int value) {
        if (capacity == 0) return;

        if (keyMap.containsKey(key)) {
            // Update the value and frequency
            keyMap.get(key).value = value;
            get(key); // This will update the frequency
        } else {
            if (keyMap.size() >= capacity) {
                // Evict the least frequently used key
                evict();
            }
            // Insert the new key
            keyMap.put(key, new Node(key, value));
            freqMap.putIfAbsent(1, new LinkedHashSet<>());
            freqMap.get(1).add(key);
            minFreq = 1;
        }
    }

    private void evict() {
        // Find the least frequently used key
        LinkedHashSet<Integer> minFreqKeys = freqMap.get(minFreq);
        if (minFreqKeys != null && !minFreqKeys.isEmpty()) {
            int lfuKey = minFreqKeys.iterator().next();
            minFreqKeys.remove(lfuKey);
            if (minFreqKeys.isEmpty()) {
                freqMap.remove(minFreq);
            }
            keyMap.remove(lfuKey);
        }
    }
}

/**
 * Your LFUCache object will be instantiated and called as such:
 * LFUCache obj = new LFUCache(capacity);
 * int param_1 = obj.get(key);
 * obj.put(key,value);
 */
    