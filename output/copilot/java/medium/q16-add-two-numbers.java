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
    public ListNode addTwoNumbers(ListNode l1, ListNode l2) { 
        ListNode dummyHead = new ListNode(0); // Dummy node to simplify the result list
        ListNode current = dummyHead; // Pointer to build the new list
        int carry = 0; // Variable to store carry from addition

        while (l1 != null || l2 != null || carry > 0) {
            int sum = carry; // Start with carry

            if (l1 != null) {
                sum += l1.val; // Add value from l1 if available
                l1 = l1.next; // Move to next node in l1
            }

            if (l2 != null) {
                sum += l2.val; // Add value from l2 if available
                l2 = l2.next; // Move to next node in l2
            }

            carry = sum / 10; // Calculate new carry
            current.next = new ListNode(sum % 10); // Create new node with the digit
            current = current.next; // Move to the next node in result list
        }

        return dummyHead.next; // Return the next of dummy head which is the actual result list
    }
}
    