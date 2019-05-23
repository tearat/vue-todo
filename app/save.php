<?php
     
$filename = $_SERVER['DOCUMENT_ROOT'].'/data/data.json';

if ( !empty($_POST['content']) )
{
    file_put_contents( $filename, $_POST['content'] );
    header($_SERVER['SERVER_PROTOCOL']." 202 Accepted");
    header('Content-Type: text/plain');
    echo "php: file saved";
}