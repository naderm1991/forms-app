<?php

$array = [3,5,4];

function custom_sort($array){

}
// input array [-1,-2]

// sort the array

// remove duplication from the array

// get the lowest item first item plus 1

// loop through the array from the second item

// if lowest item 0 make it 1

// if lowest item  not exist return it

// output 1


function solution_1(array $arr): int
{
    $set = [];

    foreach ($arr as $value) {
        if ($value > 0) {
            $set[$value] = $value;
            echo "<pre/>";
            var_dump($set);
        }
    }

    for ($i = 1; isset($set[$i]); $i++);

    return $i;
}


function solution($A): int
{
    $a = array_flip($A);echo "<pre/>";
    var_dump($a);
    for($i=1; isset($a[$i]);$i++);
    return $i;
}
echo solution(array(1, 3, 6, 4, 1, 2));//5
//echo/ solution(array(1, 2, 3));//4
//echo solution(array(-5, 1));//1















die;
$number = 5; // odd 1*2*3 even 2*3

function OddFactorial($number,$is_odd=true){
    $result=1;
    $j=$is_odd?1:2;
    for ($i=1;$i<=$number;$i++) {
        if ( $i & $j ) {
            $result = $result * $i;
        }
    }
    return $result;
}


function binarySearch(Array $arr, $x)
{
    // check for empty array
    if (count($arr) === 0) return false;
    $low = 0;
    $high = count($arr) - 1;

    while ($low <= $high) {

        // compute middle index
        $mid = floor(($low + $high) / 2);

        echo "test".$mid ." ";
        // element found at mid
        if($arr[$mid] == $x) {
            return true;
        }

        if ($x < $arr[$mid]) {
            echo "test search";
            // search the left side of the array
            $high = $mid -1;
        }
        else {
            echo "test right";
            // search the right side of the array
            $low = $mid + 1;
        }
    }

    // If we reach here element x doesnt exist
    return false;
}

// Driver code
$arr = array(1,4);
$value = 4;
if(binarySearch($arr, $value)) {
    echo" Exists". $value;
}
else {
    echo $value." Doesnt Exist";
}

//echo OddFactorial($number,false);