<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Admin section. User control</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<?php //загрузка меню
include_once ('./files/templates/admin/admin_menu.php');?>
<form action="" method="get">
    <input type="hidden" name="service" value="user">
    <input type="hidden" name="action" value="add">
    <p>Введите логин нового пользователя <input type="text" name="login" required></p>
    <p>Введите пароль <input type="password" name="pass1" required></p>
    <p>Повторите пароль <input type="password" name="pass2" required></p>
    <p class="error"><?php if (isset($fail)) {echo $fail;}?></p>
    <input type="submit" value="Зарегистрировать">
</form>

</body>
</html>