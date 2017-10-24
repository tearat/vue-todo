<?php
    if ( !empty( $_POST['content'] ) )
    {
        $file = '../data/people.txt';
        file_put_contents( $file, $_POST['content'] );
    }
    header('location: /');
?>