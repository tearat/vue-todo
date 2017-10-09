<?php
    if ( !empty($_POST['content']) )
    {
        $file = '../data/people.txt';
        $current = $_POST['content'];
        file_put_contents($file, $current);
    }
    header('location: /');
?>