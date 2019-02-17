<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Admin section. Category add</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<?php //загрузка меню
include_once ('./files/templates/admin/admin_menu.php');?>

<form action="" method="post">
    <input type="hidden" name="service" value="categories">
    <input type="hidden" name="action" value="rename">
    <input type="hidden" name="c_id" value="<?php echo $_GET['c_id'];?>">
    <p>Введите название категории <input type="text" name="c_name" required></p>
    <input type="submit" value="Переименовать">
</form>

</body>
</html>