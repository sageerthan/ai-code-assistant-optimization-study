/** https://leetcode.com/problems/merge-two-sorted-lists */
// Problem: Merge Two Sorted Lists

//Problem Description:
//You are given the heads of two sorted linked lists list1 and list2.
//Merge the two lists into one sorted list. The list should be made by splicing together the nodes of the first two lists.
//Return the head of the merged linked list.

// Constraints:
// The number of nodes in both lists is in the range [0, 50].
// -100 <= Node.val <= 100
//Both list1 and list2 are sorted in non-decreasing order.

//Code Structure:
/**
 * Definition for singly-linked list.
 * function ListNode(val, next) {
 *     this.val = (val===undefined ? 0 : val)
 *     this.next = (next===undefined ? null : next)
 * }
 */
/**
 * @param {ListNode} list1
 * @param {ListNode} list2
 * @return {ListNode}
 */
var mergeTwoLists = function(list1, list2) {
    // Create a dummy node to serve as the head of the merged list
    let dummy = new ListNode(-1);
    let current = dummy;

    // Traverse both lists and merge them
    while (list1 && list2) {
        if (list1.val < list2.val) {
            current.next = list1;
            list1 = list1.next;
        } else {
            current.next = list2;
            list2 = list2.next;
        }
        current = current.next;
    }

    // Append the remaining nodes of the non-empty list
    if (list1) {
        current.next = list1;
    }
    if (list2) {
        current.next = list2;
    }

    // Return the head of the merged list (excluding the dummy node)
    return dummy.next;
};
    