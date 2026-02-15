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
            return null;
        }
        
        return $this->mergeKListsHelper($lists, 0, count($lists) - 1);
    }
    
    private function mergeKListsHelper($lists, $start, $end) {
        if ($start === $end) {
            return $lists[$start];
        }
        
        if ($start > $end) {
            return null;
        }
        
        $mid = intval(($start + $end) / 2);
        $left = $this->mergeKListsHelper($lists, $start, $mid);
        $right = $this->mergeKListsHelper($lists, $mid + 1, $end);
        
        return $this->mergeTwoLists($left, $right);
    }
    
    private function mergeTwoLists($list1, $list2) {
        $dummy = new ListNode(0);
        $current = $dummy;
        
        while ($list1 !== null && $list2 !== null) {
            if ($list1->val <= $list2->val) {
                $current->next = $list1;
                $list1 = $list1->next;
            } else {
                $current->next = $list2;
                $list2 = $list2->next;
            }
            $current = $current->next;
        }
        
        if ($list1 !== null) {
            $current->next = $list1;
        } else {
            $current->next = $list2;
        }
        
        return $dummy->next;
    }
}
    