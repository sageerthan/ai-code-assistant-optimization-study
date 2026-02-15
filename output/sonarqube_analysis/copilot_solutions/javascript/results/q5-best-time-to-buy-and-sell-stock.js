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

/**
 * @param {number[]} prices
 * @return {number}
 */
var maxProfit = function(prices) {
    let minPrice = Infinity; // Initialize minPrice to a very high value
    let maxProfit = 0; // Initialize maxProfit to 0

    for (let price of prices) {
        // Update minPrice if the current price is lower
        if (price < minPrice) {
            minPrice = price;
        } else {
            // Calculate profit if we sell at the current price
            const profit = price - minPrice;
            // Update maxProfit if the calculated profit is higher
            if (profit > maxProfit) {
                maxProfit = profit;
            }
        }
    }

    return maxProfit; // Return the maximum profit found
    
};
    