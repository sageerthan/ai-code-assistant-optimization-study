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
 * function ListNode(val, next) {
 *     this.val = (val===undefined ? 0 : val)
 *     this.next = (next===undefined ? null : next)
 * }
 */
/**
 * @param {ListNode[]} lists
 * @return {ListNode}
 */
var mergeKLists = function(lists) {
    const dummy = new ListNode(0);
    let current = dummy;

    const comparator = (a, b) => a.val - b.val;

    let heap = [];
    for (let i = 0; i < lists.length; i++) {
        if (lists[i]) {
            heap.push(lists[i]);
        }
    }

    heap.sort(comparator);
    while (heap.length > 0) {
        current.next = heap[0];
        current = current.next;
        if (heap[0].next) {
            heap[0] = heap[0].next;
        } else {
            heap.shift();
        }
        heap.sort(comparator);
    }

    return dummy.next;
};
    