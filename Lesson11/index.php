<?php
//стартуем сессию и записываем данные о подклчении к БД
session_start();
$_SESSION['db_name'] = 'rbagrov';
$_SESSION['db_user'] = 'rbagrov';
$_SESSION['db_pass'] = 'neto1918';

include_once('./core/dbconnect.php');
//Получаем данные о таблицах в БД
$tables_show = $db->prepare("SHOW TABLES FROM `lesson10`");
$tables_show->execute();
$tables = $tables_show->fetchAll(PDO::FETCH_NUM);

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Работа с БД</title>
    <style type="text/css">
        table {
            margin-top: 15px;
            border-collapse: collapse;
        }
        thead tr {
            font-weight: bold;
            background-color: #a9a9a9;
        }
        tbody tr:nth-child(even) {
            background-color: lightgrey;
        }
        td {
            padding: 3px;
            border-width: 1px;
            border-style: solid;
            border-color: #cccccc;
        }
        .inputline {
            display: inline-block;
        }
    </style>
</head>
<body>
    <table>
        <tr><td><a href="./core/form_add.php">Создать новую таблицу</a></td></tr>
        <tr><td><strong>Название таблицы</strong></td></tr>
        <?php foreach ($tables as $key => $t_value): ?>
        <tr>
            <td><?php echo $t_value[0]?></td>
            <td><a href="core/form_table.php?t_name=<?php echo $t_value[0]?> ">Открыть</a></td>
        </tr>
        <?php endforeach;?>
    </table>

</body>
</html>


