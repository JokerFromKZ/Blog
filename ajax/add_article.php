<?php

$title = trim(filter_var($_POST['title'] , FILTER_SANITIZE_STRING));  // фильтруем логины пароли и тд и используем функ. trim для обрезания строки
$intro = trim(filter_var($_POST['intro'] , FILTER_SANITIZE_STRING));
$text = trim($_POST['text']); // убрал фильтр для коррекции статьи с помощью html

$error = '';
if(strlen($title) <= 3)
    $error = 'Write the correct article title'; // вывод ошибки
elseif(strlen($intro) <= 15)  // проверка данных на длину
    $error = 'Write the correct intro';
elseif (strlen($text) <= 20)
    $error = 'Write the correct text';

if($error != '') { // проверка на ошибку
    echo $error;
    exit();
}


require_once '../mysql_connect.php';
$sql = 'INSERT INTO articles(title, intro, text, date, author) VALUES (? , ? , ? , ? , ? )'; // подключаемся к базе юзер и добавляем определенные данные
$query =  $pdo->prepare($sql); // подготовляем наш запрос
$query->execute([$title, $intro, $text, time(), $_COOKIE['login']]); // вставляем наши данные


echo 'Done'; // передастся к переменной дата и выйдет на кнопке в случае успеха

?>
