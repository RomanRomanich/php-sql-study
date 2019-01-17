<?php
session_start();
#Старт сессии и опредление основных переменных
if (empty($_SESSION['dbUser']) || empty($_SESSION['dbPass']) || empty($_SESSION['dbName'])) {
    $_SESSION['dbUser'] = 'rbagrov';
    $_SESSION['dbPass'] = 'neto1918';
    $_SESSION['dbName'] = 'rbagrov';
}

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<form action="check.php" method="post">
    <p>Логин<input type="text" name="user" required></p>
    <p>Пароль<input type="text" name="pass" required></p>
    <p><input type="submit"></p>
</form>

<form action="register.php" method="post">
    <input type="submit" value="зарегистрироваться">
</form>

</form>
</body>
</html>
