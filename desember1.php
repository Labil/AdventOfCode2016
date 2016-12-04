<?php

$map = ['R4', 'R4', 'L1', 'R3', 'L5', 'R2', 'R5', 'R1', 'L4', 'R3', 'L5', 'R2', 'L3', 'L4', 'L3', 'R1', 'R5', 'R1', 'L3', 'L1', 'R3','L1', 'R2', 'R2', 'L2', 'R5', 'L3', 'L4', 'R4', 'R4', 'R2', 'L4', 'L1', 'R5', 'L1', 'L4', 'R4', 'L1', 'R1', 'L2', 'R5', 'L2', 'L3', 'R2', 'R1', 'L194', 'R2', 'L4', 'R49', 'R1', 'R3', 'L5', 'L4', 'L1', 'R4', 'R2', 'R1', 'L5', 'R3', 'L5', 'L4', 'R4', 'R4', 'L2', 'L3', 'R78', 'L5', 'R4', 'R191', 'R4', 'R3', 'R1', 'L2', 'R1', 'R3', 'L1', 'R3', 'R4', 'R2', 'L2', 'R1', 'R4', 'L5', 'R2', 'L2', 'L4', 'L2', 'R1', 'R2', 'L3', 'R5', 'R2', 'L3', 'L3', 'R3', 'L1', 'L1', 'R5', 'L4', 'L4', 'L2', 'R5', 'R1', 'R4', 'L3', 'L5', 'L4', 'R5', 'L4', 'R5', 'R4', 'L3', 'L2', 'L5', 'R4', 'R3', 'L3', 'R1', 'L5', 'R5', 'R1', 'L3', 'R2', 'L5', 'R5', 'L3', 'R1', 'R4', 'L5', 'R4', 'R2', 'R3', 'L4', 'L5', 'R3', 'R4', 'L5', 'L5', 'R4', 'L4', 'L4', 'R1', 'R5', 'R3', 'L1', 'L4', 'L3', 'L4', 'R1', 'L5', 'L1', 'R2', 'R2', 'R4', 'R4', 'L5', 'R4', 'R1', 'L1', 'L1', 'L3', 'L5', 'L2', 'R4', 'L3', 'L5', 'L4', 'L1', 'R3'];

$map2 = [R8, R4, R4, R8];

$currDir = 'N';
$xBlocksFromStart = 0;
$yBlocksFromStart = 0;

// Part 2
$visited = array();


function go($num, $dir) {
	$newDir;
	global $xBlocksFromStart, $yBlocksFromStart, $currDir, $visited;

	if($dir == 'R') {
		switch($currDir) {
		case 'N':
			$newDir = 'E';
			break;
		case 'E':
			$newDir = 'S';
			break;
		case 'S':
			$newDir = 'W';
			break;
		case 'W':
			$newDir = 'N';
			break;
		}
	} else {
		switch($currDir){
		case 'N':
			$newDir = 'W';
			break;
		case 'E':
			$newDir = 'N';
			break;
		case 'S':
			$newDir = 'E';
			break;
		case 'W':
			$newDir = 'S';
			break;
		}
	}

	if($newDir == 'N') {
		for ($i = 1; $i <= $num; $i++) {
			$coordPair = $xBlocksFromStart . '_' . ($yBlocksFromStart - $i);
			echo $coordPair;
			echo "\n";
			if ($visited[$coordPair]) {
				echo "found! " . ($yBlocksFromStart - $i) . ' _ ' . $xBlocksFromStart;
				echo "\n";
				return true;
			}
			$visited[$coordPair] = true;
		}
		$yBlocksFromStart -= $num;
	} else if($newDir == 'E'){
		for ($i = 1; $i <= $num; $i++) {
			$coordPair = ($xBlocksFromStart + $i) . '_' . $yBlocksFromStart;
			echo $coordPair;
			echo "\n";
			if ($visited[$coordPair]) {
				echo "found!" . ($xBlocksFromStart + $i) . ' _ ' . $yBlocksFromStart;
				echo "\n";
				return true;
			}
			$visited[$coordPair] = true;
		}
		$xBlocksFromStart += $num;
	} else if($newDir == 'W'){
		for ($i = 1; $i <= $num; $i++) {
			$coordPair = ($xBlocksFromStart - $i) . '_' . $yBlocksFromStart;
			echo $coordPair;
			echo "\n";
			if ($visited[$coordPair]) {
				echo "found!" . ($xBlocksFromStart) - $i . ' _ ' . $yBlocksFromStart;
				echo "\n";
				return true;
			}
			$visited[$coordPair] = true;
		}
		$xBlocksFromStart -= $num;
	} else if($newDir == 'S'){
		for ($i = 1; $i <= $num; $i++) {
			$coordPair = $xBlocksFromStart . '_' . ($yBlocksFromStart + $i);
			echo $coordPair;
			echo "\n";
			if ($visited[$coordPair]) {
				echo "found!" . ($yBlocksFromStart + $i) . ' _ ' . $xBlocksFromStart;
				echo "\n";
				return true;
			}
			$visited[$coordPair] = true;
		}
		$yBlocksFromStart += $num;
	}

	$currDir = $newDir;
}

foreach($map as $value) {
	$found = false;
	$dir = substr($value, 0, 1);
	$num = (int)substr($value, 1);

	go($num, $dir);

}

echo "y:" . $yBlocksFromStart;
echo "\n";
echo "x:" . $xBlocksFromStart;
