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
 * function ListNode(val, next) {
 *     this.val = (val===undefined ? 0 : val)
 *     this.next = (next===undefined ? null : next)
 * }
 */
/**
 * @param {ListNode} l1
 * @param {ListNode} l2
 * @return {ListNode}
 */
var addTwoNumbers = function(l1, l2) {
    let dummyHead = new ListNode(0); // Create a dummy head for the result linked list
    let current = dummyHead; // Pointer to build the new linked list
    let carry = 0; // Initialize carry to 0

    while (l1 || l2 || carry) { // Continue until both lists and carry are processed
        const val1 = l1 ? l1.val : 0; // Get value from l1 or 0 if l1 is null
        const val2 = l2 ? l2.val : 0; // Get value from l2 or 0 if l2 is null

        const sum = val1 + val2 + carry; // Calculate sum of values and carry
        carry = Math.floor(sum / 10); // Update carry for next iteration
        current.next = new ListNode(sum % 10); // Create a new node with the digit value
        current = current.next; // Move to the next node

        if (l1) l1 = l1.next; // Move to the next node in l1 if it exists
        if (l2) l2 = l2.next; // Move to the next node in l2 if it exists
    }

    return dummyHead.next; // Return the next node after the dummy head, which is the start of the result linked list
};
    