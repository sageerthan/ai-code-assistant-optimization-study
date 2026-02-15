<?php
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
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val = 0, $next = null) {
 *         $this->val = $val;
 *         $this->next = $next;
 *     }
 * }
 */
class Solution {

    /**
     * @param ListNode[] $lists
     * @return ListNode
     */
    function mergeKLists($lists) {
        if (empty($lists)) {
            return null; // If the input list is empty, return null
        }

        // Use a min-heap to efficiently get the smallest element
        $minHeap = new SplPriorityQueue();
        
        // Initialize the heap with the head of each list
        foreach ($lists as $list) {
            if ($list !== null) {
                $minHeap->insert($list, -$list->val); // Use negative value for min-heap behavior
            }
        }

        $dummy = new ListNode(0);
        $current = $dummy;

        while (!$minHeap->isEmpty()) {
            $node = $minHeap->extract(); // Get the smallest node
            $current->next = $node; // Add it to the merged list
            $current = $current->next; // Move to the next position
            
            if ($node->next !== null) {
                $minHeap->insert($node->next, -$node->next->val); // Add the next node from the same list
            }
        }

        return $dummy->next; // Return the merged linked list starting from the first node  
    }
}
    