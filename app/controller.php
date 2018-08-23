<?php

    $filename = $_SERVER['DOCUMENT_ROOT'].'/data/data.json';

    if ( !empty($_POST['content']) )
    {
        file_put_contents( $filename, $_POST['content'] );
        echo "php: file saved";
    }

?>