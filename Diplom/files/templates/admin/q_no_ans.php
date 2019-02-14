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
        <td>Дата вопроса</td>
        <td>Вопрос</td>
        <td>Имя задавшего</td>
        <td>Электронная почта</td>
    </tr>
    </thead>
    <?php foreach ($quests as $questArray):?>
    <tr>
        <td><?=$questArray['date']?></td>
        <td><?=$questArray['quest']?></td>
        <td><?=$questArray['quester_name']?></td>
        <td><?=$questArray['quester_mail']?></td>
        <td><a href="?service=q_no_ans&action=quest_change&q_id=<?=$questArray['id']?>">Внести исправления</a></td>
        <td><a href="?service=q_no_ans&action=ansver_add&q_id=<?=$questArray['id']?>">Добавить ответ</a></td>
        <td><a href="?service=q_no_ans&action=delete&q_id=<?=$questArray['id']?>">Удалить вопрос</a></td>
    </tr>
    <?php endforeach;?>



</table>


</body>
</html>
