<?php
//
//$username = trim(filter_var($_POST['username'] , FILTER_SANITIZE_STRING));  // фильтруем логины пароли и тд и используем функ. trim для обрезания строки
//$email = trim(filter_var($_POST['email'] , FILTER_SANITIZE_EMAIL));
$login = trim(filter_var($_POST['login'] , FILTER_SANITIZE_STRING));
$pass = trim(filter_var($_POST['pass'] , FILTER_SANITIZE_STRING));

$error = '';
if (strlen($login) <= 3)
    $error = 'Write the correct login';
elseif (strlen($pass) <= 3)
    $error = 'Write the correct password';

if($error != '') { // проверка на ошибку
    echo $error;
    exit();
}

$hash = 'ckdxzjcnhbhbq2';
$pass = md5($pass . $hash);  // кодируем наш пароль и добоваляем хеш


require_once '../mysql_connect.php';

$sql = 'SELECT `id` FROM `users` WHERE `login` = :login && `pass` = :pass'; // подключаемся к базе юзер и добавляем определенные данные
$query =  $pdo->prepare($sql); // подготовляем наш запрос
$query->execute(['login' => $login , "pass" => $pass]); // вставляем наши данные


$user = $query-> fetch(PDO::FETCH_OBJ);
if ($user->id = 0)
    echo 'no such user';
else {
    setcookie('login', $login , time() + 3600 * 24 * 30, "/"); // добавления логина в cookie
    echo 'Done';
}


?>
