<?php

$dictionary = [];

$handle = fopen($argv[1], 'r');
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $character = explode('=', $line);
        $dictionary[$character[0]] = trim($character[1]);
    }

    fclose($handle);
}

$string = $argv[2];

$replacements = 0;
$count = 0;
foreach ($dictionary as $character => $replacement) {
    $string = str_replace($character, $replacement, $string, $count);
    $replacements += $count;
}

echo $string;
echo "\n";
echo "{$replacements} sustituciones";
echo "\n";
