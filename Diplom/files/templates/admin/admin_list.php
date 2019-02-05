<?php
?>

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

<table>
    <thead>
    <tr>
        <td>Логин администратора</td>
        <td colspan="2" align="right"><a href="?service=user&action=add">Добавить нового пользователя</a></td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($admins as $admin_name): ?>
        <tr>
            <td> <?=$admin_name['login'];?> </td>
            <td><a href="?service=user&action=delete&us_id=<?=$admin_name['id'];?>">Удалить пользователя</a></td>
            <td><a href="?service=user&action=pass_change&us_id=<?=$admin_name['id'];?>">Установить новый пароль</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>