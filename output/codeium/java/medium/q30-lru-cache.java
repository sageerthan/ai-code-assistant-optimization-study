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

// First generated code
class LRUCache {

    private int capacity;
    private Map<Integer, Integer> keyToValue = new HashMap<>();
    private Map<Integer, Integer> keyToCount = new HashMap<>();
    private Map<Integer, LinkedHashSet<Integer>> countToLRUKeys = new HashMap<>();
    private int minCount = 0;
    
    public LRUCache(int capacity) {
        this.capacity = capacity;
    }
    
    public int get(int key) {
        if (!keyToValue.containsKey(key)) {
            return -1;
        }
        int count = keyToCount.get(key);
        keyToCount.put(key, count + 1);
        countToLRUKeys.get(count).remove(key);
        if (countToLRUKeys.get(count).size() == 0) {
            countToLRUKeys.remove(count);
            if (count == minCount) {
                minCount++;
            }
        }

        countToLRUKeys.computeIfAbsent(count + 1, z -> new LinkedHashSet<>()).add(key);
        return keyToValue.get(key);
    }
    
    public void put(int key, int value) {
        if (capacity <= 0) {
            return;
        }
        if (keyToValue.containsKey(key)) {
            keyToValue.put(key, value);
            get(key);
            return;
        }
        if (keyToValue.size() >= capacity) {
            int evict = countToLRUKeys.get(minCount).iterator().next();
            keyToValue.remove(evict);
            keyToCount.remove(evict);
            countToLRUKeys.get(minCount).remove(evict);
            if (countToLRUKeys.get(minCount).size() == 0) {
                countToLRUKeys.remove(minCount);
            }
        }
        keyToValue.put(key, value);
        keyToCount.put(key, 1);
        minCount = 1;
        countToLRUKeys.computeIfAbsent(1, z -> new LinkedHashSet<>()).add(key);
    }
}

/**
 * Your LRUCache object will be instantiated and called as such:
 * LRUCache obj = new LRUCache(capacity);
 * int param_1 = obj.get(key);
 * obj.put(key,value);
 */

// Debugged Code

import java.util.LinkedHashMap;

class LRUCache {
    private int capacity;
    private final LinkedHashMap<Integer, Integer> cache;

    public LRUCache(int capacity) {
        this.capacity = capacity;
        this.cache = new LinkedHashMap<Integer, Integer>();
    }

    public int get(int key) {
        if (cache.containsKey(key)) {
            int value = cache.get(key);
            cache.remove(key);
            cache.put(key, value);
            return value;
        }
        return -1;
    }

    public void put(int key, int value) {
        if (cache.containsKey(key)) {
            cache.remove(key);
        } else if (cache.size() == capacity) {
            cache.remove(cache.keySet().iterator().next());
        }
        cache.put(key, value);
    }
}