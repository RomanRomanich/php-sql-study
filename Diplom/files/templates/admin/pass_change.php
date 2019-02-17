<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Смена пароля</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<?php //загрузка меню
include_once ('./files/templates/admin/admin_menu.php');?>
<form action="" method="post">
    <input type="hidden" name="service" value="user">
    <input type="hidden" name="action" value="pass_change">
    <input type="hidden" name="us_id" value="<?php echo $_GET['us_id'];?>">
    <p>Введите новый пароль для пользователя <input type="password" name="pass1" required></p>
    <p>Повторите пароль <input type="password" name="pass2" required></p>
    <p class="error"><?php if (isset($fail)) {echo $fail;}?></p>
    <input type="submit" value="Зарегистрировать">
</form>
</body>
</html>