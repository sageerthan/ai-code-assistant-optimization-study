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

class LFUCache {
    private int capacity;
    private Map<Integer, Integer> keyToValue = new HashMap<>();
    private Map<Integer, Integer> keyToCount = new HashMap<>();
    private Map<Integer, LinkedHashSet<Integer>> countToLRUKeys = new HashMap<>();
    private int minCount = 0;

    public LFUCache(int capacity) {
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
 * Your LFUCache object will be instantiated and called as such:
 * LFUCache obj = new LFUCache(capacity);
 * int param_1 = obj.get(key);
 * obj.put(key,value);
 */
    