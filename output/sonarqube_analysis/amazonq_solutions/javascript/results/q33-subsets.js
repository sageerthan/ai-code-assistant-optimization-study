/** https://leetcode.com/problems/subsets */
// Problem: Subsets

//Problem Description:
//Given an integer array nums of unique elements, return all possible subsets (the power set).
//The solution set must not contain duplicate subsets. Return the solution in any order.

// Constraints:
// 1 <= nums.length <= 10
// -10 <= nums[i] <= 10
// All the numbers of nums are unique.

//Code Structure:

/**
 * @param {number[]} nums
 * @return {number[][]}
 */
var subsets = function(nums) {
    let result = [];
    let subset = [];
    function dfs(i) {
        if (i >= nums.length) {
            result.push([...subset]);
            return;
        }
        subset.push(nums[i]);
        dfs(i + 1);
        subset.pop();
        dfs(i + 1);
    }
    dfs(0);
    return result;
};
    