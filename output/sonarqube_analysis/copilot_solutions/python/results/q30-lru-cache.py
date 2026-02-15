# https://leetcode.com/problems/lru-cache/
# Problem: LRU Cache

#Problem Description:
#Design a data structure that follows the constraints of a Least Recently Used (LRU) cache.
#Implement the LRUCache class:
#LRUCache(int capacity) Initialize the LRU cache with positive size capacity.
#int get(int key) Return the value of the key if the key exists, otherwise return -1.
#void put(int key, int value) Update the value of the key if the key exists. Otherwise, add the key-value pair to the cache. If the number of keys exceeds the capacity from this operation, evict the least recently used key.
#The functions get and put must each run in O(1) average time complexity.

# Constraints:
# 1 <= capacity <= 3000
# 0 <= key <= 10^4
# 0 <= value <= 10^5
# At most 2 * 105 calls will be made to get and put.

#Code Structure:

class LRUCache(object):

    def __init__(self, capacity):
        """
        :type capacity: int
        """
        self.capacity = capacity
        self.cache = {}
        self.order = []
        

    def get(self, key):
        """
        :type key: int
        """
        if key in self.cache:
            # Move the accessed key to the end of the order list
            self.order.remove(key)
            self.order.append(key)
            return self.cache[key]
        return -1
        

    def put(self, key, value):
        """
        :type key: int
        :rtype: None
        """
        if key in self.cache:
            # Update the value
            self.cache[key] = value
            # Move the accessed key to the end of the order list
            self.order.remove(key)
            self.order.append(key)
        else:
            if len(self.cache) >= self.capacity:
                # Evict the least recently used key
                lru_key = self.order.pop(0)
                del self.cache[lru_key]
            # Add the new key-value pair
            self.cache[key] = value
            self.order.append(key)

# Your LRUCache object will be instantiated and called as such:
# obj = LRUCache(capacity)
# param_1 = obj.get(key)
# obj.put(key,value)                                                                                                  
    