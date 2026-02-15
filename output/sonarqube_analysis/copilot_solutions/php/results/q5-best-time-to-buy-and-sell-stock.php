<?php
/** https://leetcode.com/problems/best-time-to-buy-and-sell-stock */
// Problem: Best Time to Buy and Sell Stock

//Problem Description:
//You are given an array prices where prices[i] is the price of a given stock on the ith day.
//You want to maximize your profit by choosing a single day to buy one stock and choosing a different day in the future to sell that stock.
//Return the maximum profit you can achieve from this transaction. If you cannot achieve any profit, return 0.

// Constraints:
// 1 <= prices.length <= 10^5
// 0 <= prices[i] <= 10^4

//Code Structure:
class Solution {

    /**
     * @param Integer[] $prices
     * @return Integer
     */
    function maxProfit($prices) {
        $minPrice = PHP_INT_MAX; // Initialize to the maximum possible integer
        $maxProfit = 0; // Initialize maximum profit to 0

        foreach ($prices as $price) {
            if ($price < $minPrice) {
                $minPrice = $price; // Update minimum price if current price is lower
            } elseif ($price - $minPrice > $maxProfit) {
                $maxProfit = $price - $minPrice; // Update maximum profit if current profit is higher
            }
        }

        return $maxProfit; // Return the maximum profit found   
    }
}
    