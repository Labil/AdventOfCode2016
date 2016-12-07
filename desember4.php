<?php

$data = fopen('desember4_data.php', 'r') or die('Unable to open file...');

$sectorIDs = array();
$alphabet = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
$alphabetLength = count($alphabet);
$allRoomNames = array();

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

			$sectorID = (int)preg_replace('/[^0-9]/', '', $line);
			$sectorIDs[] = $sectorID; 

			// Find how many times we need to shift each letter forward,
			// as the length of the whole  alphabet will only get us back to our starting point
			$rest = $sectorID % $alphabetLength;
			
			$str = substr($line, 0, $posChecksumStart - 3);
			$strArr = str_split($str);

			$decrypted = array();
			foreach($strArr as $char) {
				if ($char !== '-') {
					$indexInAlphabet = array_search($char, $alphabet);
					if ($indexInAlphabet) {
						$decryptedIndex = $indexInAlphabet + $rest;
						if ($decryptedIndex >= $alphabetLength) {
							$decryptedIndex = $decryptedIndex - $alphabetLength;
						}
						$decrypted[] = $alphabet[$decryptedIndex];
					}
				} else {
					$decrypted[] = ' ';
				}
			}
			$allRoomNames[$sectorID] = implode('', $decrypted);
		}
	}

}

fclose($data);

echo "Num rooms: " . count($sectorIDs) . "\n";
echo "Sector ids: " .implode(' ', $sectorIDs) . "\n";

$sumSectorIDs = 0;
foreach($sectorIDs as $id) {
	$sumSectorIDs += (int)$id;
}

echo "Sum sector ids: " . $sumSectorIDs . "\n";


var_dump($allRoomNames);
echo "\n";
// $matches = preg_grep('/stor/', $allRoomNames);
// var_dump($matches);

