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
    def __init__(self, key=0, value=0):
        self.key = key
        self.value = value
        self.freq = 1
        self.prev = None
        self.next = None

class DoublyLinkedList:
    def __init__(self):
        self.head = Node()
        self.tail = Node()
        self.head.next = self.tail
        self.tail.prev = self.head
        self.size = 0
    
    def add_to_head(self, node):
        node.next = self.head.next
        node.prev = self.head
        self.head.next.prev = node
        self.head.next = node
        self.size += 1
    
    def remove_node(self, node):
        node.prev.next = node.next
        node.next.prev = node.prev
        self.size -= 1
    
    def remove_tail(self):
        if self.size > 0:
            last_node = self.tail.prev
            self.remove_node(last_node)
            return last_node
        return None

class LFUCache(object):

    def __init__(self, capacity):
        """
        :type capacity: int
        """
        self.capacity = capacity
        self.cache = {}  # key -> node
        self.freq_map = {}  # freq -> DoublyLinkedList
        self.min_freq = 0

    def get(self, key):
        """
        :type key: int
        :rtype: int
        """
        if key not in self.cache:
            return -1
        
        node = self.cache[key]
        self.update_frequency(node)
        return node.value

    def put(self, key, value):
        """
        :type key: int
        :type value: int
        :rtype: None
        """
        if self.capacity == 0:
            return
        
        if key in self.cache:
            node = self.cache[key]
            node.value = value
            self.update_frequency(node)
        else:
            if len(self.cache) >= self.capacity:
                self.evict_least_frequent()
            
            new_node = Node(key, value)
            self.cache[key] = new_node
            self.add_to_freq_list(new_node)
            self.min_freq = 1
    
    def update_frequency(self, node):
        # Remove from current frequency list
        self.remove_from_freq_list(node)
        
        # Update frequency
        node.freq += 1
        
        # Add to new frequency list
        self.add_to_freq_list(node)
    
    def add_to_freq_list(self, node):
        freq = node.freq
        if freq not in self.freq_map:
            self.freq_map[freq] = DoublyLinkedList()
        self.freq_map[freq].add_to_head(node)
    
    def remove_from_freq_list(self, node):
        freq = node.freq
        if freq in self.freq_map:
            self.freq_map[freq].remove_node(node)
            if self.freq_map[freq].size == 0:
                del self.freq_map[freq]
                if freq == self.min_freq:
                    self.min_freq += 1
    
    def evict_least_frequent(self):
        if self.min_freq in self.freq_map:
            freq_list = self.freq_map[self.min_freq]
            node_to_remove = freq_list.remove_tail()
            if node_to_remove:
                del self.cache[node_to_remove.key]
                if freq_list.size == 0:
                    del self.freq_map[self.min_freq]
# Your LFUCache object will be instantiated and called as such:
# obj = LFUCache(capacity)
# param_1 = obj.get(key)
# obj.put(key,value)                                                                 
    