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

class Node:
    def __init__(self, key, val):
        self.key = key
        self.val = val
        self.freq = 1
        self.prev = None
        self.next = None

class DLL:
    def __init__(self):
        self.head = Node(0, 0)
        self.tail = Node(0, 0)
        self.head.next = self.tail
        self.tail.prev = self.head
        self.size = 0
    
    def add(self, node):
        node.next = self.head.next
        node.prev = self.head
        self.head.next.prev = node
        self.head.next = node
        self.size += 1
    
    def remove(self, node):
        node.prev.next = node.next
        node.next.prev = node.prev
        self.size -= 1
    
    def remove_last(self):
        last = self.tail.prev
        self.remove(last)
        return last

class LFUCache(object):

    def __init__(self, capacity):
        """
        :type capacity: int
        """
        self.capacity = capacity
        self.min_freq = 0
        self.key_to_node = {}
        self.freq_to_list = {}

    def get(self, key):
        """
        :type key: int
        :rtype: int
        """
        if key not in self.key_to_node:
            return -1
        node = self.key_to_node[key]
        self.update_freq(node)
        return node.val

    def put(self, key, value):
        """
        :type key: int
        :type value: int
        :rtype: None
        """
        if self.capacity == 0:
            return
        
        if key in self.key_to_node:
            node = self.key_to_node[key]
            node.val = value
            self.update_freq(node)
        else:
            if len(self.key_to_node) >= self.capacity:
                min_freq_list = self.freq_to_list[self.min_freq]
                to_remove = min_freq_list.remove_last()
                del self.key_to_node[to_remove.key]
            
            new_node = Node(key, value)
            self.key_to_node[key] = new_node
            if 1 not in self.freq_to_list:
                self.freq_to_list[1] = DLL()
            self.freq_to_list[1].add(new_node)
            self.min_freq = 1
    
    def update_freq(self, node):
        old_freq = node.freq
        old_list = self.freq_to_list[old_freq]
        old_list.remove(node)
        
        if old_freq == self.min_freq and old_list.size == 0:
            self.min_freq += 1
        
        node.freq += 1
        if node.freq not in self.freq_to_list:
            self.freq_to_list[node.freq] = DLL()
        self.freq_to_list[node.freq].add(node)
# Your LFUCache object will be instantiated and called as such:
# obj = LFUCache(capacity)
# param_1 = obj.get(key)
# obj.put(key,value)                                                                 
    