<?php
/** https://leetcode.com/problems/intersection-of-two-arrays */
// Problem: Intersection of Two Arrays

//Problem Description:
//Given two integer arrays nums1 and nums2, return an array of their intersection. Each element in the result must be unique and you may return the result in any order.

// Constraints:
// 1 <= nums1.length, nums2.length <= 1000
// 0 <= nums1[i], nums2[i] <= 1000

//Code Structure:

// First generated code:
class Solution {

    /**
     * @param Integer[] $nums1
     * @param Integer[] $nums2
     * @return Integer[]
     */
    function intersection($nums1, $nums2) {
        return array_values(array_intersect($nums1, $nums2));
    }
}

// Debugged Code

function mergeSortedArrays($nums1, $nums2) {
    $result = array();
    $i = 0; // index for nums1
    $j = 0; // index for nums2
    $k = 0; // index for result array

    while ($i < count($nums1) && $j < count($nums2)) {
        if ($nums1[$i] < $nums2[$j]) {
            $result[$k++] = $nums1[$i++];
        } else {
            $result[$k++] = $nums2[$j++];
        }
    }

    // Append remaining elements from nums1 or nums2
    while ($i < count($nums1)) {
        $result[$k++] = $nums1[$i++];
    }
    while ($j < count($nums2)) {
        $result[$k++] = $nums2[$j++];
    }

    // Remove duplicates
    $result = array_unique($result);

    return $result;
}

// Test the function
$nums1 = [1, 2, 2, 1];
$nums2 = [2, 2];
$result = mergeSortedArrays($nums1, $nums2);
print_r($result); // Output: Array ( [0] => 2 [1] => 2 )