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

# First generated code:

class LFUCache(object):

    def __init__(self, capacity):
        """
        :type capacity: int
        """
        self.capacity = capacity
        self.cache = {}
        self.freq = {}
        self.min_freq = 0

    def get(self, key):
        """
        :type key: int
        :rtype: int
        """
        if key not in self.cache:
            return -1
        
        # Increment the frequency of the key
        self.freq[key] += 1
        freq = self.freq[key]
        
        # Update the minimum frequency if necessary
        if freq == 1:
            self.min_freq = 1
        elif freq > self.min_freq and all(f < freq for f in self.freq.values()):
            self.min_freq = freq
        
        return self.cache[key]
        

    def put(self, key, value):
        """
        :type key: int
        :type value: int
        :rtype: None
        """
        if self.capacity <= 0:
            return
        
        if key in self.cache:
            # Update the value and increment frequency
            self.cache[key] = value
            self.freq[key] += 1
        else:
            if len(self.cache) >= self.capacity:
                # Evict the least frequently used key
                lfu_key = min(self.freq, key=lambda k: (self.freq[k], k))
                del self.cache[lfu_key]
                del self.freq[lfu_key]
            
            # Insert the new key
            self.cache[key] = value
            self.freq[key] = 1
            self.min_freq = 1
        
# Your LFUCache object will be instantiated and called as such:
# obj = LFUCache(capacity)
# param_1 = obj.get(key)
# obj.put(key,value)                                                                 
    

# Debugged Code

class LFUCache(object):

    def __init__(self, capacity):
        """
        :type capacity: int
        """
        self.capacity = capacity
        self.cache = {}           # key -> value
        self.freq = {}            # key -> frequency
        self.freq_to_keys = {}    # frequency -> OrderedDict of keys (for LRU)
        self.min_freq = 0

    def get(self, key):
        """
        :type key: int
        :rtype: int
        """
        if key not in self.cache:
            return -1
        
        self._update_frequency(key)
        return self.cache[key]

    def put(self, key, value):
        """
        :type key: int
        :type value: int
        :rtype: None
        """
        if self.capacity <= 0:
            return
        
        if key in self.cache:
            # Update existing key
            self.cache[key] = value
            self._update_frequency(key)
        else:
            # Add new key
            if len(self.cache) >= self.capacity:
                # Evict LFU key (least recently used among those with min frequency)
                self._evict()
            
            self.cache[key] = value
            self.freq[key] = 1
            if 1 not in self.freq_to_keys:
                self.freq_to_keys[1] = {}
            self.freq_to_keys[1][key] = True
            self.min_freq = 1
    
    def _update_frequency(self, key):
        """Update frequency of a key and maintain LRU order"""
        old_freq = self.freq[key]
        new_freq = old_freq + 1
        
        # Remove from old frequency list
        del self.freq_to_keys[old_freq][key]
        
        # If old frequency list is empty and it was min_freq, increment min_freq
        if len(self.freq_to_keys[old_freq]) == 0:
            del self.freq_to_keys[old_freq]
            if old_freq == self.min_freq:
                self.min_freq = new_freq
        
        # Add to new frequency list
        if new_freq not in self.freq_to_keys:
            self.freq_to_keys[new_freq] = {}
        self.freq_to_keys[new_freq][key] = True
        
        # Update frequency
        self.freq[key] = new_freq
    
    def _evict(self):
        """Evict the least frequently used and least recently used key"""
        # Get the LRU key from min_freq bucket
        lfu_key = next(iter(self.freq_to_keys[self.min_freq]))
        
        # Remove from cache
        del self.cache[lfu_key]
        del self.freq[lfu_key]
        del self.freq_to_keys[self.min_freq][lfu_key]
        
        # Clean up empty frequency bucket
        if len(self.freq_to_keys[self.min_freq]) == 0:
            del self.freq_to_keys[self.min_freq]
        
# Your LFUCache object will be instantiated and called as such:
# obj = LFUCache(capacity)
# param_1 = obj.get(key)
# obj.put(key,value)                                                                 
    