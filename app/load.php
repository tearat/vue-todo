<?php

$dirname = $_SERVER['DOCUMENT_ROOT'].'/data';
$filename = $_SERVER['DOCUMENT_ROOT'].'/data/data.json';

if (!is_dir( $dirname )) {
    mkdir($_SERVER['DOCUMENT_ROOT']."/data");
}

if (!file_exists( $filename )) {
    file_put_contents( $filename, "[]" );
}
$data = file_get_contents( $filename );
header($_SERVER['SERVER_PROTOCOL']." 200 OK");
header('Content-Type: application/json');
echo json_encode($data);