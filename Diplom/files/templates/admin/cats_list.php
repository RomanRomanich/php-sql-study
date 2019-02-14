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
    <?php foreach ($cats as $cats_name): ?>
        <tr>
            <td> <?=$cats_name['cat_name'];?> </td>
            <td><?php $quest = new \models\Questions($this->db); echo $quest->questsCount($cats_name['id'])['counts'];?></td>
            <td><?php $quest = new \models\Questions($this->db); echo $quest->questsCount($cats_name['id'], 0)['counts'];?></td>
            <td><?php $quest = new \models\Questions($this->db); echo $quest->questsCount($cats_name['id'], 1)['counts'];?></td>
            <td><a href="?service=categories&action=rename&c_id=<?=$cats_name['id'];?>">Изменить название</a></td>
            <td><a href="?service=categories&action=delete&c_id=<?=$cats_name['id'];?>">Удалить категорию <br> (все связанные вопросы и ответы буду удалены) </a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>