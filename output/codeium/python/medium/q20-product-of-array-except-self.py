# https://leetcode.com/problems/product-of-array-except-self/
# Problem: Product of Array Except Self

#Problem Description:
#Given an integer array nums, return an array answer such that answer[i] is equal to the product of all the elements of nums except nums[i].
#The product of any prefix or suffix of nums is guaranteed to fit in a 32-bit integer.
#You must write an algorithm that runs in O(n) time and without using the division operation.

# Constraints:
# 2 <= nums.length <= 10^5
# -30 <= nums[i] <= 30
# The input is generated such that answer[i] is guaranteed to fit in a 32-bit integer.

#Code Structure:

class Solution(object):
    def productExceptSelf(self, nums):
        """
        :type nums: List[int]
        :rtype: List[int]
        """
        # The length of the input array
        length = len(nums)
        
        # The output array to be returned
        answer = [0]*length
        
        # The product of all the numbers to the left
        # Note: for the element at index '0', there are no elements to the left,
        # so the product is 1
        left_product = 1;
        for i in range(length):
            # The answer at index 'i' is the product of all the numbers to the left
            answer[i] = left_product
            
            # Update the product of all the numbers to the left
            left_product *= nums[i]
        
        # The product of all the numbers to the right
        # Note: for the element at index 'length - 1', there are no elements to the right,
        # so the product is 1
        right_product = 1;
        for i in reversed(range(length)):
            # The answer at index 'i' is the product of all the numbers to the left
            # and all the numbers to the right
            answer[i] *= right_product
            
            # Update the product of all the numbers to the right
            right_product *= nums[i]
        
        return answer
    