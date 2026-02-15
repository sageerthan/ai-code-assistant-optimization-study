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
    // Create a dummy node to simplify the merging process
    let dummy = new ListNode(0);
    let current = dummy;

    // Traverse both lists and merge them
    while (list1 !== null && list2 !== null) {
        if (list1.val < list2.val) {
            current.next = list1; // Link the smaller node
            list1 = list1.next; // Move to the next node in list1
        } else {
            current.next = list2; // Link the smaller node
            list2 = list2.next; // Move to the next node in list2
        }
        current = current.next; // Move to the next position in the merged list
    }

    // If there are remaining nodes in either list, link them
    if (list1 !== null) {
        current.next = list1;
    } else if (list2 !== null) {
        current.next = list2;
    }

    // Return the merged list, which starts from the next of dummy node
    return dummy.next;
    
};
    