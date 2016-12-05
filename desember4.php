<?php

$data = fopen('desember4_data.php', 'r') or die('Unable to open file...');

$numRooms = 0;
$sectorIDs = array();

while(!feof($data)) {
	$line = fgets($data);

	$letters = str_split($line);


	if (count($letters) > 5) {
		$obj = array();
		foreach($letters as $char) {
			if (preg_match('/\-|\[|\]|[0-9]|\s/', $char) === 0) {
				if (!$obj[$char]) {
					$obj[$char] = 0;
				}
				$obj[$char]++;
			}
		}
		// First sort by highest occurrence, then if values are equal, sort alphabetically
		array_multisort(array_values($obj), SORT_DESC, array_keys($obj), SORT_ASC, $obj);
	
		$posChecksumStart = strpos($line, "[");
		$checksum = substr($line, $posChecksumStart + 1, 5);

		$sorted = array_keys($obj);

		if ($checksum == $sorted[0] . $sorted[1] . $sorted[2] . $sorted[3] . $sorted[4]) {
			$numRooms++;
			$sectorIDs[] = preg_replace('/[^0-9]/', '', $line);
		}
	}

}

echo "Num rooms: " . $numRooms;
echo "\n";
echo "Sector ids: " .implode(' ', $sectorIDs);

$sumSectorIDs = 0;
foreach($sectorIDs as $id) {
	$sumSectorIDs += (int)$id;
}

echo "\n";
echo "Sum sector ids: " . $sumSectorIDs;

fclose($data);


