<?php
//Форма для добавления новой таблицы
session_start();
include_once('./dbconnect.php');
$i = 1; //просто счетчик для формирования необходимого количества форм
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Работа с БД</title>
</head>
<body>
    <form action="" method="GET">
        Количество полей таблицы <input type="text" name="t_fields">
        <input type="submit" value="Указать">
    </form>
    <?php if (!empty($_GET['t_fields'])): ?>
    <form action="./sql_add.php" method="POST">
        <p>Название таблицы <input type="text" name="t_name" required></p>
        <?php while($i <= $_GET['t_fields']): ?>
        <p>Имя поля
        <input type="text" name="field_name[<?php echo $i ?>]" required>
        Тип поля
        <select type="text" name="field_type[<?php echo $i ?>]" required>
            <?php include("./field_type.php"); ?>
        </select></p>
        <?php $i++; endwhile; ?>
        <input type="hidden" name="count" value="<?php echo $_GET['t_fields'] ?>">
        <input type="submit" value="Создать">
    </form>
    <?php endif; ?>
    <a href="../index.php">Вернуться в начало</a>
</body>
</html>


