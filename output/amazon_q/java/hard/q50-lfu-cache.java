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
    class Node {
        int key, val, freq;
        Node prev, next;
        Node(int key, int val) {
            this.key = key;
            this.val = val;
            this.freq = 1;
        }
    }
    
    class DLL {
        Node head, tail;
        int size;
        DLL() {
            head = new Node(0, 0);
            tail = new Node(0, 0);
            head.next = tail;
            tail.prev = head;
        }
        
        void add(Node node) {
            node.next = head.next;
            node.prev = head;
            head.next.prev = node;
            head.next = node;
            size++;
        }
        
        void remove(Node node) {
            node.prev.next = node.next;
            node.next.prev = node.prev;
            size--;
        }
        
        Node removeLast() {
            Node last = tail.prev;
            remove(last);
            return last;
        }
    }
    
    int capacity, minFreq;
    Map<Integer, Node> keyToNode;
    Map<Integer, DLL> freqToList;

    public LFUCache(int capacity) {
        this.capacity = capacity;
        this.minFreq = 0;
        this.keyToNode = new HashMap<>();
        this.freqToList = new HashMap<>();
    }
    
    public int get(int key) {
        Node node = keyToNode.get(key);
        if (node == null) return -1;
        updateFreq(node);
        return node.val;
    }
    
    public void put(int key, int value) {
        if (capacity == 0) return;
        
        Node node = keyToNode.get(key);
        if (node != null) {
            node.val = value;
            updateFreq(node);
        } else {
            if (keyToNode.size() >= capacity) {
                DLL minFreqList = freqToList.get(minFreq);
                Node toRemove = minFreqList.removeLast();
                keyToNode.remove(toRemove.key);
            }
            
            Node newNode = new Node(key, value);
            keyToNode.put(key, newNode);
            freqToList.computeIfAbsent(1, k -> new DLL()).add(newNode);
            minFreq = 1;
        }
    }
    
    private void updateFreq(Node node) {
        int oldFreq = node.freq;
        DLL oldList = freqToList.get(oldFreq);
        oldList.remove(node);
        
        if (oldFreq == minFreq && oldList.size == 0) {
            minFreq++;
        }
        
        node.freq++;
        freqToList.computeIfAbsent(node.freq, k -> new DLL()).add(node);
    }
}

/**
 * Your LFUCache object will be instantiated and called as such:
 * LFUCache obj = new LFUCache(capacity);
 * int param_1 = obj.get(key);
 * obj.put(key,value);
 */
    