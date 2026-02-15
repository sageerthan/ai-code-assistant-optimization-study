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
    private final Map<Character, String> digitMap = Map.of(
        '2', "abc", '3', "def", '4', "ghi", '5', "jkl",
        '6', "mno", '7', "pqrs", '8', "tuv", '9', "wxyz"
    );
    
    public List<String> letterCombinations(String digits) {
        if (digits.isEmpty()) {
            return List.of();
        }
        
        List<String> result = new ArrayList<>();
        backtrack(result, "", digits);
        return result;
    }
    
    private void backtrack(List<String> result, String current, String remaining) {
        if (remaining.isEmpty()) {
            result.add(current);
            return;
        }
        
        for (char c : digitMap.get(remaining.charAt(0)).toCharArray()) {
            backtrack(result, current + c, remaining.substring(1));
        }
    }
}
    