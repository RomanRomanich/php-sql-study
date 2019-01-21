<?php
session_start();
include_once('./dbconnect.php');

$t_name = $_GET['t_name'];

$t_stucture = $db->prepare('DESCRIBE '.$t_name);
$t_stucture->execute();
$table = $t_stucture->fetchAll(PDO::FETCH_ASSOC);

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
        <tr><td>Название поля</td><td>Тип</td></tr>

        <?php foreach ($table as $key => $t_value): ?>
            <tr>
                <td><?php echo $t_value['Field']?></td>
                <td><?php echo $t_value['Type']?></td>
                <td><a href="./field_change.php?t_name=<?php echo $t_name?>&field_old=<?php echo $t_value['Field']?>&type_old=<?php echo $t_value['Type']?>">Изменить</a></td>
                <td><a href="./sql_change.php?remove=1&t_field=<?php echo $t_value['Field']?>&t_name=<?php echo $t_name?>">Удалить поле</a></td>

            </tr>
        <?php endforeach;?>
    </table>
    <a href="../index.php">Вернуться в начало</a>
</body>
</html>
