<?php
//    if ( !empty($_POST['content']) )
//    {
//        $file = 'people.txt';
//        // Открываем файл для получения существующего содержимого
//        $current = file_get_contents($file);
//        // Добавляем нового человека в файл
//        $current .= $_POST['content']."\n";
//        // Пишем содержимое обратно в файл
//        file_put_contents($file, $current);
//    }
//    header('location: /');

    if ( !empty($_POST['content']) )
    {
        $file = '../data/people.txt';
        $current = $_POST['content']."\n";
        file_put_contents($file, $current);
    }
    header('location: /');
?>