<?php

    $token = "token123";

    if ( ($_GET['token'] == $token) || ($_POST['token'] == $token) )
    {
        $dirname = $_SERVER['DOCUMENT_ROOT'].'/data';
        $filename = $_SERVER['DOCUMENT_ROOT'].'/data/data.json';

        if ( $_GET['read'] == 1 )
        {
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
        }

        if ( !empty($_POST['content']) )
        {
            file_put_contents( $filename, $_POST['content'] );
            header($_SERVER['SERVER_PROTOCOL']." 202 Accepted");
            header('Content-Type: text/plain');
            echo "php: file saved";
        }
    } else {
        header($_SERVER['SERVER_PROTOCOL']." 418 I'm a teapot");
    }


?>