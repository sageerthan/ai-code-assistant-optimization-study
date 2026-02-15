/** https://leetcode.com/problems/kth-largest-element-in-an-array */
// Problem: Kth Largest Element in an Array

//Problem Description:
//Given an integer array nums and an integer k, return the kth largest element in the array.
//Note that it is the kth largest element in the sorted order, not the kth distinct element.
//Can you solve it without sorting?

// Constraints:
// 1 <= k <= nums.length <= 10^5
// -10^4 <= nums[i] <= 10^4

//Code Structure:

class Solution {
    public int findKthLargest(int[] nums, int k) {
        // Use a min-heap to keep track of the k largest elements
        PriorityQueue<Integer> minHeap = new PriorityQueue<>(k);
        
        // Add elements to the min-heap
        for (int num : nums) {
            minHeap.offer(num);
            if (minHeap.size() > k) {
                minHeap.poll(); // Remove the smallest element if size exceeds k
            }
        }
        
        // The root of the min-heap is the kth largest element
        return minHeap.peek();   
    }
}
    