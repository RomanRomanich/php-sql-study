<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<p>Для перехода в административную часть введите логин и пароль</p>
<form action="" method="post">
    <p>Логин <input type="text" name="login" required></p>
    <p>Пароль <input type="password" name="password" required></p>
    <p><input type="submit" value="Вход"></p>
    <p><?php if (!empty($fail)) {echo $fail;}?></p>
    <p><a href="index.php">Вернуться на главную</a></p>
</form>
</body>
</html>
