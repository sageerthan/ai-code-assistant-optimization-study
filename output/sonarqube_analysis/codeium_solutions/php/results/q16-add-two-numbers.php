<?php
/** https://leetcode.com/problems/add-two-numbers */
// Problem: Add Two Numbers

//Problem Description:
//You are given two non-empty linked lists representing two non-negative integers. The digits are stored in reverse order, and each of their nodes contains a single digit. Add the two numbers and return the sum as a linked list.
//You may assume the two numbers do not contain any leading zero, except the number 0 itself.

// Constraints:
// The number of nodes in each linked list is in the range [1, 100].
// 0 <= Node.val <= 9
// It is guaranteed that the list represents a number that does not have leading zeros.

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
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function addTwoNumbers($l1, $l2) {
        $dummy = new ListNode(0);
        $current = $dummy;
        $carry = 0;
        while ($l1 || $l2 || $carry) {
            $sum = ($l1 ? $l1->val : 0) + ($l2 ? $l2->val : 0) + $carry;
            $carry = floor($sum / 10);
            $current->next = new ListNode($sum % 10);
            $current = $current->next;
            $l1 = $l1 ? $l1->next : null;
            $l2 = $l2 ? $l2->next : null;
        }
        return $dummy->next;
    }
}
    