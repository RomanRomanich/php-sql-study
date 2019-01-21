<?php
#Здесь форма для внесения изменения в талицу
session_start();
include_once('./dbconnect.php');

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<pre>
    <?php print_r($_GET); ?>
</pre>
<form action="sql_change.php" method="get">
    <input type="hidden" name="change" value="1">
    <?php foreach ($_GET as $key => $value): ?>
    <input type="hidden" name="<?=$key?>" value="<?=$value?>">
    <?php endforeach;?>
    <p>Новое имя поля <input type="text" name="field_new" placeholder="<?=$_GET['field_old']?>" value="<?=$_GET['field_old']?>"></p>
    <p>Ноывй тип поля
        <select name="type_new">
            <option value="<?=$_GET['type_old']?>"  selected><?=$_GET['type_old']?></option>
            <?php include_once ('./field_type.php');?>
        </select>
    </p>
    <input type="submit" value="Подтвердить">
</form>
<a href="../index.php">Вернуться в начало</a>
</body>
</html>
