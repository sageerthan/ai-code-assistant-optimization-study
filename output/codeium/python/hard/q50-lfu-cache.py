# https://leetcode.com/problems/lfu-cache/
# Problem: LFU Cache

#Problem Description:
#Design and implement a data structure for a Least Frequently Used (LFU) cache.
#Implement the LFUCache class:
#LFUCache(int capacity) Initializes the object with the capacity of the data structure.
#int get(int key) Gets the value of the key if the key exists in the cache. Otherwise, returns -1.
#void put(int key, int value) Update the value of the key if present, or inserts the key if not already present. When the cache reaches its capacity, it should invalidate and remove the least frequently used key before inserting a new item. For this problem, when there is a tie (i.e., two or more keys with the same frequency), the least recently used key would be invalidated.
#To determine the least frequently used key, a use counter is maintained for each key in the cache. The key with the smallest use counter is the least frequently used key.
#When a key is first inserted into the cache, its use counter is set to 1 (due to the put operation). The use counter for a key in the cache is incremented either a get or put operation is called on it.
#The functions get and put must each run in O(1) average time complexity.

# Constraints:

# 1 <= capacity <= 10^4
# 0 <= key <= 10^5
# 0 <= value <= 10^9
# At most 2 * 10^5 calls will be made to get and put.

#Code Structure:

# First generated code

class LFUCache(object):

    def __init__(self, capacity):
        """
        :type capacity: int
        """
        self.capacity = capacity
        self.key_node = {}
        self.count_node = {}
        self.min_count = 0
        

    def get(self, key):
        """
        :type key: int
        :rtype: int
        """
        if key not in self.key_node:
            return -1
        node = self.key_node[key]
        del self.key_node[key]

        self.count_node[node.count].remove(key)

        if not self.count_node[node.count]:
            del self.count_node[node.count]
        node.count += 1
        self.count_node.setdefault(node.count, set()).add(key)
        self.key_node[key] = node

        if self.min_count not in self.count_node:
            self.min_count += 1

        return node.value
        

    def put(self, key, value):
        """
        :type key: int
        :type value: int
        :rtype: None
        """
        if not self.capacity:
            return
        if key in self.key_node:
            node = self.key_node[key]
            del self.key_node[key]
            self.count_node[node.count].remove(key)

            if not self.count_node[node.count]:
                del self.count_node[node.count]
        else:
            if len(self.key_node) == self.capacity:
                k, n = self.count_node[self.min_count].popitem(last=False)
                del self.key_node[k]
            self.min_count = 1
        self.key_node[key] = self.Node(value, self.min_count)
        self.count_node.setdefault(self.min_count, set()).add(key)
        
# Your LFUCache object will be instantiated and called as such:
# obj = LFUCache(capacity)
# param_1 = obj.get(key)
# obj.put(key,value) 


# Debugged Code

class LFUCache:
    class Node:
        def __init__(self, key, value, count):
            self.key = key
            self.value = value
            self.count = count
            self.prev = None
            self.next = None

    def __init__(self, capacity):
        self.capacity = capacity
        self.key_node = {}
        self.count_node = {}
        self.min_count = 0

    # Rest of your code...

    def put(self, key, value):
        if not self.capacity:
            return
        if key in self.key_node:
            node = self.key_node[key]
            del self.key_node[key]
            self.count_node[node.count].remove(key)

            if not self.count_node[node.count]:
                del self.count_node[node.count]
        else:
            if len(self.key_node) == self.capacity:
                k, n = self.count_node[self.min_count].popitem(last=False)
                del self.key_node[k]
            self.min_count = 1
        self.key_node[key] = self.Node(key, value, self.min_count)
        self.count_node.setdefault(self.min_count, set()).add(key)
    