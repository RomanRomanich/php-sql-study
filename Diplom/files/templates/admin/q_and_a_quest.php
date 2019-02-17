<?php
/*$questAndAnsvers - сюда вопросы и свзязанне ответы
массив ответа
[category_id] => 1
[date] => 2019-01-28 00:24:33
[quest] => rfrfrfrfrf1
[q_name] => roman
[quest_id] => 1
[published] => 1
[c_name] => ЧаВО
[ansver] => А вот здесь ответ
[ansverer] => Админ
[a_id] => 1
[a_quest_id]

*/
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Admin section. User control</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<table>
    <thead>
    <tr>
        <td>Дата вопроса</td>
        <td>Вопрос</td>
        <td>Автор</td>
        <td>Статус</td>
        <td>Категория</td>
        <td>Ответ</td>
        <td>Автор</td>
    </tr>
    </thead>
    <?php foreach ($questAndAnsvers as $questArray):?>

        <tr id="<?=$questArray['quest_id']?>">
            <td><?=$questArray['date']?></td>
            <td><?=$questArray['quest']?></td>
            <td><?=$questArray['q_name']?></td>
            <td>
                <form action="" method="post">
                    <input type="hidden" name="service" value="q_and_ans">
                    <input type="hidden" name="action" value="q_stat_change">
                    <input type="hidden" name="c_id" value="<?=$_GET['c_id']?>">
                    <input type="hidden" name="q_id" value="<?=$questArray['quest_id']?>">
                    <select name="q_stat_change">
                        <option value="0" <?php if ($questArray['published'] == 0) {echo "selected";}?>>Неопубликован</option>
                        <option value="1" <?php if ($questArray['published'] == 1) {echo "selected";}?>>Опубликован</option>
                    </select>
                    <input type="submit" value="Изменить">
                </form>
            </td>

            <td>
                <p>
                <form class="selector" action="" method="post">
                    <input type="hidden" name="service" value="q_and_ans">
                    <input type="hidden" name="action" value="c_id_change">
                    <input type="hidden" name="q_id" value="<?=$questArray['quest_id']?>">
                    <input type="hidden" name="c_id" value="<?=$questArray['category_id']?>">
                    <select name="c_id_change">
                        <?php foreach ($cats as $cat): ?>
                            <option value="<?=$cat['id']?>" <?php if (isset($_POST['c_id']) && $_POST['c_id'] == $cat['id']) {echo "selected";}?> ><?=$cat['cat_name']?></option>
                        <?php endforeach;?>
                        <input type="submit" value="Выбрать">
                    </select>
                </form>
                </p>
            </td>

            <td><?=$questArray['ansver']?></td>
            <td><?=$questArray['ansverer']?></td>
            <td><a href="?service=q_and_ans&action=delete_q&q_id=<?=$questArray['quest_id']?>&c_id=<?=$_GET['c_id']?>">Удалить вопрос</a></td>
            <td><a href="?service=q_and_ans&action=change_q_and_a&field_show=1&c_id=<?=$_GET['c_id']?>&q_id=<?=$questArray['quest_id']?>&a_id=<?=$questArray['quest_id']?>#<?=$questArray['quest_id']?>">Редактировать</a></td>
        </tr>

        <?php if (isset($_GET['field_show']) && $_GET['field_show'] == 1 && $_GET['q_id'] == $questArray['quest_id']): ?>
        <tr>
            <td colspan="9">
                <form action="" method="post">
                    <input type="hidden" name="service" value="q_and_ans">
                    <input type="hidden" name="action" value="change_q_and_a">
                    <input type="hidden" name="c_id" value="<?=$questArray['category_id']?>">
                    <input type="hidden" name="q_id" value="<?=$questArray['quest_id']?>">
                    <input type="hidden" name="a_id" value="<?=$questArray['quest_id']?>">
                    <p>Вопрос <textarea name="q_name" cols="30" rows="3"><?=$questArray['quest']?></textarea>
                        Автор <input type="text" name="q_auth" value="<?=$questArray['q_name']?>" placeholder="<?=$questArray['q_name']?>">
                        Ответ <textarea name="ansver" cols="30" rows="3"><?=$questArray['ansver']?></textarea>
                        <input type="submit" value="Изменить">
                    </p>
                </form>
            </td>
        </tr>
        <?php endif;?>

    <?php endforeach;?>

</table>
</body>
</html>
