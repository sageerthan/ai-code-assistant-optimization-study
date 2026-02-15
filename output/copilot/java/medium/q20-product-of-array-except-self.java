/** https://leetcode.com/problems/product-of-array-except-self */
// Problem: Product of Array Except Self

//Problem Description:
//Given an integer array nums, return an array answer such that answer[i] is equal to the product of all the elements of nums except nums[i].
//The product of any prefix or suffix of nums is guaranteed to fit in a 32-bit integer.
//You must write an algorithm that runs in O(n) time and without using the division operation.

// Constraints:
// 2 <= nums.length <= 10^5
// -30 <= nums[i] <= 30
// The input is generated such that answer[i] is guaranteed to fit in a 32-bit integer.

//Code Structure:

class Solution {
    public int[] productExceptSelf(int[] nums) {
        int n = nums.length;
        int[] answer = new int[n];
        
        // Initialize the first element of answer to 1
        answer[0] = 1;
        
        // Calculate the prefix product
        for (int i = 1; i < n; i++) {
            answer[i] = answer[i - 1] * nums[i - 1];
        }
        
        // Initialize a variable to store the suffix product
        int suffixProduct = 1;
        
        // Calculate the suffix product and multiply it with the prefix product
        for (int i = n - 1; i >= 0; i--) {
            answer[i] *= suffixProduct;
            suffixProduct *= nums[i];
        }
        
        return answer;        
    }
}
    