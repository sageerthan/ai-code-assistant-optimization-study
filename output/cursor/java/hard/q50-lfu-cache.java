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

import java.util.*;

class LFUCache {
    private int capacity;
    private int minFreq;
    private Map<Integer, Integer> keyToValue;
    private Map<Integer, Integer> keyToFreq;
    private Map<Integer, LinkedHashSet<Integer>> freqToKeys;
    
    public LFUCache(int capacity) {
        this.capacity = capacity;
        this.minFreq = 0;
        this.keyToValue = new HashMap<>();
        this.keyToFreq = new HashMap<>();
        this.freqToKeys = new HashMap<>();
    }
    
    public int get(int key) {
        if (!keyToValue.containsKey(key)) {
            return -1;
        }
        
        // Update frequency
        updateFrequency(key);
        return keyToValue.get(key);
    }
    
    public void put(int key, int value) {
        if (capacity <= 0) {
            return;
        }
        
        if (keyToValue.containsKey(key)) {
            // Update existing key
            keyToValue.put(key, value);
            updateFrequency(key);
        } else {
            // Insert new key
            if (keyToValue.size() >= capacity) {
                evictLFU();
            }
            
            keyToValue.put(key, value);
            keyToFreq.put(key, 1);
            freqToKeys.computeIfAbsent(1, k -> new LinkedHashSet<>()).add(key);
            minFreq = 1;
        }
    }
    
    private void updateFrequency(int key) {
        int freq = keyToFreq.get(key);
        
        // Remove from current frequency list
        freqToKeys.get(freq).remove(key);
        if (freqToKeys.get(freq).isEmpty()) {
            freqToKeys.remove(freq);
            if (minFreq == freq) {
                minFreq++;
            }
        }
        
        // Add to new frequency list
        freq++;
        keyToFreq.put(key, freq);
        freqToKeys.computeIfAbsent(freq, k -> new LinkedHashSet<>()).add(key);
    }
    
    private void evictLFU() {
        LinkedHashSet<Integer> minFreqKeys = freqToKeys.get(minFreq);
        int keyToEvict = minFreqKeys.iterator().next();
        
        minFreqKeys.remove(keyToEvict);
        if (minFreqKeys.isEmpty()) {
            freqToKeys.remove(minFreq);
        }
        
        keyToValue.remove(keyToEvict);
        keyToFreq.remove(keyToEvict);
    }
}

/**
 * Your LFUCache object will be instantiated and called as such:
 * LFUCache obj = new LFUCache(capacity);
 * int param_1 = obj.get(key);
 * obj.put(key,value);
 */
    