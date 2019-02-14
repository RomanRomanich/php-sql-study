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
<form action="" method="get">
    <input type="hidden" name="service" value="q_no_ans">
    <input type="hidden" name="action" value="quest_change">
    <input type="hidden" name="q_id" value="<?php echo $_GET['q_id'];?>">
    <p>Внесите исправления<textarea name="q_name" cols="50" rows="5" required></textarea></p>
    <input type="submit" value="Зарегистрировать">
</form>
</body>
</html>