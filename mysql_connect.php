<?php
$user = 'root';
$password = 'root';
$db = 'test';
$host = 'localhost';

$dsn = 'mysql:host='. $host .';dbname='.$db; // добавил свой порт к которому подключена база
$pdo = new PDO($dsn, $user, $password); // подкл. к базе
