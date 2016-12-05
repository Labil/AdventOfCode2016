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
echo "\n";
echo "Part 2:";
echo "\n";
// Part 2

$numTriangles = 0;

$data = fopen("desember3_data.txt", "r") or die ("Unable to read file");

$three = [array(), array(), array()];

while(!feof($data)) {
	$line = fgets($data);
	$lineArray = preg_split('/\s+/', trim($line));

	if (count($three[0]) === 3) {
		foreach($three as $triangle) {
			if (isTriangle($triangle)) {
				$numTriangles++;
			}
		}
		$three = [array(), array(), array()];
	}

	$three[0][] = $lineArray[0];
	$three[1][] = $lineArray[1];
	$three[2][] = $lineArray[2];
}

fclose($data);

echo $numTriangles;
