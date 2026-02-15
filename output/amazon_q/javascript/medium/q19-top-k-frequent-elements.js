/** https://leetcode.com/problems/top-k-frequent-elements */
// Problem: Top K Frequent Elements

//Problem Description:
//Given an integer array nums and an integer k, return the k most frequent elements. You may return the answer in any order.

// Constraints:
// 1 <= nums.length <= 10^5
// -10^4 <= nums[i] <= 10^4
// k is in the range [1, the number of unique elements in the array].
// It is guaranteed that the answer is unique.

//Code Structure:
/**
 * @param {number[]} nums
 * @param {number} k
 * @return {number[]}
 */
var topKFrequent = function(nums, k) {
    let map = new Map();
    for (let num of nums) {
        map.set(num, (map.get(num) || 0) + 1);
    }
    let sorted = Array.from(map).sort((a, b) => b[1] - a[1]);
    let result = [];
    for (let i = 0; i < k; i++) {
        result.push(sorted[i][0]);
    }
    return result;
};
    