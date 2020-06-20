<?php
setcookie('login', '', time() - 3600 * 24 * 30, "/");
unset($_COOKIE['login']); // удаление записи логина в cookie
echo 'true';
?>