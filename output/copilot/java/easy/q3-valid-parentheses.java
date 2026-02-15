/** https://leetcode.com/problems/valid-parentheses */
// Problem: Valid Parentheses

//Problem Description:
//Given a string s containing just the characters '(', ')', '{', '}', '[' and ']', determine if the input string is valid.
//An input string is valid if:
//Open brackets must be closed by the same type of brackets.
//Open brackets must be closed in the correct order.
//Every close bracket has a corresponding open bracket of the same type.

// Constraints:
// 1 <= s.length <= 10^4
// s consists of parentheses only '()[]{}'.

//Code Structure:

class Solution {
    public boolean isValid(String s) {
        // Stack to keep track of opening brackets
        Stack<Character> stack = new Stack<>();

        // Map to hold matching pairs of brackets
        Map<Character, Character> bracketMap = new HashMap<>();
        bracketMap.put(')', '(');
        bracketMap.put('}', '{');
        bracketMap.put(']', '[');

        // Iterate through each character in the string
        for (char c : s.toCharArray()) {
            // If it's a closing bracket
            if (bracketMap.containsKey(c)) {
                // Check if the stack is empty or the top of the stack doesn't match
                if (stack.isEmpty() || stack.pop() != bracketMap.get(c)) {
                    return false; // Invalid case
                }
            } else {
                // If it's an opening bracket, push it onto the stack
                stack.push(c);
            }
        }

        // If the stack is empty, all brackets were matched correctly
        return stack.isEmpty();
    }
}
    