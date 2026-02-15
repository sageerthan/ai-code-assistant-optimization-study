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
    const result = [];
    const helper = (temp, start) => {
        result.push([...temp]);
        for (let i = start; i < nums.length; i++) {
            temp.push(nums[i]);
            helper(temp, i + 1);
            temp.pop();
        }
    }
    helper([], 0);
    return result;
};
    