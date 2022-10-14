<?php

$open = fopen('shooting_starts.csv', 'r');

while (($data = fgetcsv($open, 1000, ',')) !== FALSE) {
    $array[] = $data;
}

unset($array[0]);

// YEAR AVERAGE
echo 'Year Average:';
echo '<br>';
echo '------------';
echo '<br>';

$years = [];
foreach ($array as $data) {
    $years[$data[0]][] = studentAvg($data);
}

foreach ($years as $year => $averages) {
    $years[$year] = array_sum($averages) / count($averages);
}

arsort($years);
foreach ($years as $year => $average) {
    echo "{$year}: {$average}";
    echo '<br>';
}


echo '<br>';
echo '<br>';
echo '<br>';
// BEST SECTION
echo 'Best Section:';
echo '<br>';
echo '------------';
echo '<br>';

$sections = [];
foreach ($array as $data) {
    $sections["{$data[0]}{$data[1]}"][] = studentAvg($data);
}

foreach ($sections as $section => $averages) {
    $sections[$section] = array_sum($averages) / count($averages);
}

arsort($sections);
echo array_key_first($sections);

echo '<br>';
echo '<br>';
echo '<br>';
// TOP 3 STUDENTS
echo 'Top 3 students:';
echo '<br>';
echo '--------------';
echo '<br>';

$students = [];
foreach ($array as $data) {
    $students[$data[2]] = studentAvg($data);
}

arsort($students);

$count = 0;
foreach ($students as $name => $average) {
    if( $count >= 3) break;
    echo "{$name} ({$average})";
    echo '<br>';
    $count++;
}

// Functions
function studentAvg($student) {
    $notes = explode('|', $student[3]);

    $total = 0;

    for ($i = 0; $i < count($notes); $i++) {
        $total += $notes[$i];
    }

    return $total / count($notes);
}
