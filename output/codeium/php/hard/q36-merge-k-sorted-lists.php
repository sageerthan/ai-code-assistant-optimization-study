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

// First generated code

// class Solution {

//     /**
//      * @param ListNode[] $lists
//      * @return ListNode
//      */
//     function mergeKLists($lists) {
//         $dummy = new ListNode(0);
//         $current = $dummy;
        
//         $heap = [];
//         for ($i = 0; $i < count($lists); $i++) {
//             if ($lists[$i]) {
//                 $heap[] = $lists[$i];
//             }
//         }
        
//         while (count($heap) > 0) {
//             usort($heap, function ($a, $b) {
//                 return $a->val - $b->val;
//             });
            
//             $current->next = array_shift($heap);
//             $current = $current->next;
            
//             if ($current->next) {
//                 array_unshift($heap, $current->next);
//             }
//         }
        
//         return $dummy->next;
//     }
// }

// Debugged Code

class Solution {

    /**
     * @param ListNode[] $lists
     * @return ListNode
     */
    function mergeKLists($lists) {
        $dummy = new ListNode(0);
        $current = $dummy;
        
        $heap = [];
        for ($i = 0; $i < count($lists); $i++) {
            if ($lists[$i]) {
                $heap[] = $lists[$i];
                $this->heapify($heap, count($heap)-1);
            }
        }
        
        while (count($heap) > 0) {
            $current->next = array_shift($heap);
            $current = $current->next;
            
            if ($current->next) {
                $this->heapify($heap, 0);
            }
        }
        
        return $dummy->next;
    }
    
    function heapify(&$heap, $index) {
        $left = $index * 2 + 1;
        $right = $index * 2 + 2;
        $min = $index;
        
        if ($left < count($heap) && $heap[$left]->val < $heap[$min]->val) {
            $min = $left;
        }
        
        if ($right < count($heap) && $heap[$right]->val < $heap[$min]->val) {
            $min = $right;
        }
        
        if ($min != $index) {
            $temp = $heap[$min];
            $heap[$min] = $heap[$index];
            $heap[$index] = $temp;
            $this->heapify($heap, $min);
        }
    }
}
    