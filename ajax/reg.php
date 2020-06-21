<?php

    $username = trim(filter_var($_POST['username'] , FILTER_SANITIZE_STRING));  // фильтруем логины пароли и тд и используем функ. trim для обрезания строки
    $email = trim(filter_var($_POST['email'] , FILTER_SANITIZE_EMAIL));
    $login = trim(filter_var($_POST['login'] , FILTER_SANITIZE_STRING));
    $pass = trim(filter_var($_POST['pass'] , FILTER_SANITIZE_STRING));

    $error = '';
    if(strlen($username) <= 3)
        $error = 'Write the correct name'; // вывод ошибки
    elseif(strlen($email) <= 3)  // проверка данных на длину
        $error = 'Write the correct email';
    elseif (strlen($login) <= 3)
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
    $sql = 'INSERT INTO users( name , email , login , pass) VALUES (? , ? , ? , ?)'; // подключаемся к базе юзер и добавляем определенные данные
    $query =  $pdo->prepare($sql); // подготовляем наш запрос
    $query->execute([$username, $email, $login, $pass]); // вставляем наши данные


    echo 'Done'; // передастся к переменной дата и выйдет на кнопке в случае успеха

?>
