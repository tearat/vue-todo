<?php

$data = file_get_contents('../data/data.json');
header($_SERVER['SERVER_PROTOCOL']." 200 OK");
header('Content-Type: application/json');
$tasks = json_decode($data);

echo "Todo list: \n\n";

foreach ($tasks as $task) {
    if( $task->done ) {
        echo "[X] ";
    } else {
        echo "[ ] ";
    }
    echo $task->title . "\n";
}

echo "\n";
echo "http://".$_SERVER['HTTP_HOST'] . "\n";
