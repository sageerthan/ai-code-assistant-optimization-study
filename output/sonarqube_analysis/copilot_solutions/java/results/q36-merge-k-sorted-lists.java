/** https://leetcode.com/problems/merge-k-sorted-lists */
// Problem: Merge K Sorted Lists

//Problem Description:
//You are given an array of k linked-lists lists, each linked-list is sorted in ascending order.
//Merge all the linked-lists into one sorted linked-list and return it.

// Constraints:
// k == lists.length
// 0 <= k <= 10^4
// 0 <= lists[i].length <= 500
// -10^4 <= lists[i][j] <= 10^4
// lists[i] is sorted in ascending order.
// The sum of lists[i].length will not exceed 10^4.


//Code Structure:

/**
 * Definition for singly-linked list.
 * public class ListNode {
 *     int val;
 *     ListNode next;
 *     ListNode() {}
 *     ListNode(int val) { this.val = val; }
 *     ListNode(int val, ListNode next) { this.val = val; this.next = next; }
 * }
 */
class Solution {
    public ListNode mergeKLists(ListNode[] lists) {
        if (lists == null || lists.length == 0) {
            return null; // If the input is empty, return null
        }

        // Use a priority queue (min-heap) to merge the k sorted lists
        PriorityQueue<ListNode> minHeap = new PriorityQueue<>((a, b) -> a.val - b.val);

        // Add the head of each list to the min-heap
        for (ListNode list : lists) {
            if (list != null) {
                minHeap.offer(list);
            }
        }

        ListNode dummy = new ListNode(0); // Dummy node to simplify the result list construction
        ListNode current = dummy;

        // While there are nodes in the min-heap
        while (!minHeap.isEmpty()) {
            ListNode node = minHeap.poll(); // Get the smallest node from the heap
            current.next = node; // Add it to the result list
            current = current.next; // Move to the next position in the result list

            if (node.next != null) {
                minHeap.offer(node.next); // If there is a next node, add it to the heap
            }
        }

        return dummy.next; // Return the merged sorted list starting from the first real node
    }
}
    