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
        $mergedList = null;
        $current = null;

        while (true) {
            $minIndex = -1;
            $minValue = PHP_INT_MAX;

            foreach ($lists as $index => $list) {
                if ($list !== null && $list->val < $minValue) {
                    $minIndex = $index;
                    $minValue = $list->val;
                }
            }

            if ($minIndex === -1) {
                break;
            }

            if ($mergedList === null) {
                $mergedList = new ListNode($minValue);
                $current = $mergedList;
            } else {
                $current->next = new ListNode($minValue);
                $current = $current->next;
            }

            $lists[$minIndex] = $lists[$minIndex]->next;
        }

        return $mergedList;
    }
}
    