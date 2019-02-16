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

<?php //var_dump($_GET); ?>

<table>
    <thead>
    <tr>
        <td>Название категории</td>
        <td>Всего вопросов</td>
        <td>Опубликовано</td>
        <td>Не опубликовано</td>
        <td><a href="?service=categories&action=add">Добавить новую категорию</a></td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($cats as $catsName): ?>
        <tr>
            <td><?=$catsName['cat_name'];?> </td>
            <td><?=$catsName['total'];?></td>
            <td><?=$catsName['pub'];?></td>
            <td><?=$catsName['unpub'];?></td>
            <td><a href="?service=categories&action=rename&c_id=<?=$catsName['id'];?>">Изменить название</a></td>
            <td><a href="?service=categories&action=delete&c_id=<?=$catsName['id'];?>">Удалить категорию <br> (все связанные вопросы и ответы буду удалены) </a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>