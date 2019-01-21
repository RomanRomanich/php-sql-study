<?php
#Исполняем запрос на добавление новой таблицы
session_start();
include_once('./dbconnect.php');

//формируем строку для добавления
for ($i=1; $i <= $_POST['count']; $i++) {
    $string[$i] = '`'.$_POST['field_name'][$i].'` '.$_POST['field_type'][$i];
}
$sql_string = implode(', ', $string);

//собственно сам запрос
$sql_table = $_POST['t_name'];

$sql_add = $db->prepare('CREATE TABLE '.$sql_table.' ('.$sql_string.')');
$sql_add->execute();
header('Location: ../index.php');
?>

