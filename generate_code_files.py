import os

def main():       
    filename = "lfu-cache"

    context_comment = """
Design and implement a data structure for a Least Frequently Used (LFU) cache.

Implement the LFUCache class:

LFUCache(int capacity) Initializes the object with the capacity of the data structure.
int get(int key) Gets the value of the key if the key exists in the cache. Otherwise, returns -1.
void put(int key, int value) Update the value of the key if present, or inserts the key if not already present. When the cache reaches its capacity, it should invalidate and remove the least frequently used key before inserting a new item. For this problem, when there is a tie (i.e., two or more keys with the same frequency), the least recently used key would be invalidated.
To determine the least frequently used key, a use counter is maintained for each key in the cache. The key with the smallest use counter is the least frequently used key.

When a key is first inserted into the cache, its use counter is set to 1 (due to the put operation). The use counter for a key in the cache is incremented either a get or put operation is called on it.

The functions get and put must each run in O(1) average time complexity.


Problem: LFU Cache

Problem Description:
Design and implement a data structure for a Least Frequently Used (LFU) cache.
Implement the LFUCache class:
LFUCache(int capacity) Initializes the object with the capacity of the data structure.
int get(int key) Gets the value of the key if the key exists in the cache. Otherwise, returns -1.
void put(int key, int value) Update the value of the key if present, or inserts the key if not already present. When the cache reaches its capacity, it should invalidate and remove the least frequently used key before inserting a new item. For this problem, when there is a tie (i.e., two or more keys with the same frequency), the least recently used key would be invalidated.
To determine the least frequently used key, a use counter is maintained for each key in the cache. The key with the smallest use counter is the least frequently used key.
When a key is first inserted into the cache, its use counter is set to 1 (due to the put operation). The use counter for a key in the cache is incremented either a get or put operation is called on it.
The functions get and put must each run in O(1) average time complexity.


Constraints:

1 <= capacity <= 10^4
0 <= key <= 10^5
0 <= value <= 10^9
At most 2 * 10^5 calls will be made to get and put.

Code Structure:
"""
    python_content = """
class LFUCache(object):

    def __init__(self, capacity):
        \"\"\"
        :type capacity: int
        \"\"\"
        

    def get(self, key):
        \"\"\"
        :type key: int
        :rtype: int
        \"\"\"
        

    def put(self, key, value):
        \"\"\"
        :type key: int
        :type value: int
        :rtype: None
        \"\"\"
        
# Your LFUCache object will be instantiated and called as such:
# obj = LFUCache(capacity)
# param_1 = obj.get(key)
# obj.put(key,value)                                                                 
    """

    php_content = """
class LFUCache {
    /**
     * @param Integer $capacity
     */
    function __construct($capacity) {
        
    }
  
    /**
     * @param Integer $key
     * @return Integer
     */
    function get($key) {
        
    }
  
    /**
     * @param Integer $key
     * @param Integer $value
     * @return NULL
     */
    function put($key, $value) {
        
    }
}

/**
 * Your LFUCache object will be instantiated and called as such:
 * $obj = LFUCache($capacity);
 * $ret_1 = $obj->get($key);
 * $obj->put($key, $value);
 */
    """

    js_content = """
/**
 * @param {number} capacity
 */
var LFUCache = function(capacity) {
    
};

/** 
 * @param {number} key
 * @return {number}
 */
LFUCache.prototype.get = function(key) {
    
};

/** 
 * @param {number} key 
 * @param {number} value
 * @return {void}
 */
LFUCache.prototype.put = function(key, value) {
    
};

/** 
 * Your LFUCache object will be instantiated and called as such:
 * var obj = new LFUCache(capacity)
 * var param_1 = obj.get(key)
 * obj.put(key,value)
 */
    """

    java_content = """
class LFUCache {

    public LFUCache(int capacity) {
        
    }
    
    public int get(int key) {
        
    }
    
    public void put(int key, int value) {
        
    }
}

/**
 * Your LFUCache object will be instantiated and called as such:
 * LFUCache obj = new LFUCache(capacity);
 * int param_1 = obj.get(key);
 * obj.put(key,value);
 */
    """
    
    extension_content_dict = {
        ".py": python_content,
        ".java": java_content,
        ".js": js_content,
        ".php": php_content
    }

    extension_path_dict = {
        ".py": "output/python/",
        ".java": "output/java/",
        ".js": "output/javascript/",
        ".php": "output/php/"
    }

    print("Creating and Copying Comment and Function Name to all dirs...")

    # 🔧 Create folders if they don't exist
    for path in extension_path_dict.values():
        os.makedirs(path, exist_ok=True)

    for key, value in extension_content_dict.items():
        file = extension_path_dict[key] + filename + key
        # with open(file, 'w') as f:
        with open(file, 'w', encoding='utf-8') as f:
            if key == ".py":
                f.write("# https://leetcode.com/problems/" + filename + "/\n")
                for comment in context_comment.splitlines():
                    if comment != "":
                        f.write('#' + comment + '\n')
            elif key == ".php":
               f.write("<?php\n")
               f.write("// https://leetcode.com/problems/" + filename + "\n")
               for comment in context_comment.strip().splitlines():
                    f.write('// ' + comment + '\n')
            else:
                f.write("/** https://leetcode.com/problems/" + filename + " */\n")
                for comment in context_comment.splitlines():
                    if comment != "":
                        f.write('//' + comment + '\n')
            f.write(value)

main()
