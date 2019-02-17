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
<form action="" method="post">
    <input type="hidden" name="service" value="q_no_ans">
    <input type="hidden" name="action" value="ansver_add">
    <input type="hidden" name="q_id" value="<?=$_GET['q_id'];?>">
    <p>Напишите ответ</p><textarea name="ansver" cols="30" rows="5" required></textarea>
    <p>Имя ответившего <input type="text" name="ansverer_name" value="<?=$_SESSION['admin_name']?>" placeholder="<?=$_SESSION['admin_name']?>" required></p>
    <p>Опубликовать<input type="checkbox" name="publish" value="1"></p>
    <input type="submit" value="Ответить">
</form>

</body>
</html>