<?php
$file = "text.txt";
$fileOpen = fopen($file, "r");
$arr = [];
$arrHeadingOne = [];
$arrHeadingTwo = [];
$arrHeadingThree = [];
$i = -1;
$j = -1;

while (!feof($fileOpen)) {
    $contents = fgets($fileOpen, filesize($file));
    $subStr = substr($contents, 0, 3);
    $numberOfDash = substr_count($subStr, '-');
    if ($numberOfDash == 0) {
        $i++;
        $arrHeadingOne[$i] = $contents;
    } elseif ($numberOfDash == 2) {
        $j++;
        $arrHeadingTwo[$i][$j] = $contents;
    } elseif ($numberOfDash == 3) {
        $arrHeadingThree[$j][] = $contents;
    }
}
foreach ($arrHeadingOne as $key => $arrayOne) {
    $arr1 = [];
    $arr2 = [];
    $arr1['name'] = $arrayOne;
    if (isset($arrHeadingTwo[$key])) {
        foreach ($arrHeadingTwo[$key] as $key2 => $arrayTwo) {
            $arr2['name'] = $arrayTwo;
            $arr2['children'] = $arrHeadingThree[$key2] ?? [];
            $arr1['children'][] = $arr2;
        }
    }

    $arr[] = $arr1;
}
print_r(json_encode($arr));
fclose($fileOpen);
