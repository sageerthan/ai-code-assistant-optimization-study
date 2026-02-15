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
    const frequencyMap = new Map(); // Map to store frequency of each number

    // Count the frequency of each number
    for (const num of nums) {
        frequencyMap.set(num, (frequencyMap.get(num) || 0) + 1);
    }

    // Convert the map to an array of [number, frequency] pairs
    const frequencyArray = Array.from(frequencyMap.entries());

    // Sort the array by frequency in descending order
    frequencyArray.sort((a, b) => b[1] - a[1]);

    // Extract the top k frequent elements
    return frequencyArray.slice(0, k).map(([num]) => num);  
};
    