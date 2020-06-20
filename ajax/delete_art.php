<?php
$id = trim($_POST['id']);  // фильтруем логины пароли и тд и используем функ. trim для обрезания строки
require_once '../mysql_connect.php';
$sql = 'DELETE FROM `articles` WHERE `articles`.`id` = ?;'; // подключаемся к базе юзер и добавляем определенные данные
$query =  $pdo->prepare($sql); // подготовляем наш запрос
$query->execute([$id]); // вставляем наши данные
