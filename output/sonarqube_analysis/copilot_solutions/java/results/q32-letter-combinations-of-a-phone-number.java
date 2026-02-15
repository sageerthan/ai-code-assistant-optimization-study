/** https://leetcode.com/problems/letter-combinations-of-a-phone-number */
// Problem: Letter Combinations of a Phone Number

//Problem Description:
//Given a string containing digits from 2-9 inclusive, return all possible letter combinations that the number could represent. Return the answer in any order.
//A mapping of digits to letters (just like on the telephone buttons) is given below. Note that 1 does not map to any letters.

// Constraints:
// 0 <= digits.length <= 4
// digits[i] is a digit in the range ['2', '9'].

//Code Structure:

class Solution {
    public List<String> letterCombinations(String digits) {
        List<String> result = new ArrayList<>();
        if (digits == null || digits.length() == 0) {
            return result; // Return empty list if input is empty
        }

        String[] mapping = {
            "", "", "abc", "def", "ghi", "jkl", "mno", "pqrs", "tuv", "wxyz"
        };

        backtrack(digits, 0, new StringBuilder(), result, mapping);
        return result; // Return the list of letter combinations    
    }

    private void backtrack(String digits, int index, StringBuilder current, List<String> result, String[] mapping) {
        if (index == digits.length()) {
            result.add(current.toString());
            return;
        }

        String letters = mapping[digits.charAt(index) - '0'];
        for (char c : letters.toCharArray()) {
            current.append(c);
            backtrack(digits, index + 1, current, result, mapping);
            current.deleteCharAt(current.length() - 1);
        }
    }
}
    