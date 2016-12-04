<?php

function isTriangle($arr) {
	// return $arr[0] + $arr[1] > $arr[2] && $arr[1] + $arr[2] > $arr[0] && $arr[2] + $arr[0] > $arr[1];
	sort($arr, SORT_NUMERIC);
	return $arr[2] < $arr[0] + $arr[1];
}

$numTriangles = 0;

$data = fopen("desember3_data.txt", "r") or die ("Unable to read file");


while(!feof($data)) {
	$line = fgets($data);
//	$triangle = explode(' ', $line);
//	$triangle = array_filter($triangle);

	$triangle = preg_split('/\s+/', trim($line));

	if (count($triangle) == 3) {
		if (isTriangle($triangle)) {
			$numTriangles++;
		}
	}
}

fclose($data);

echo $numTriangles;
