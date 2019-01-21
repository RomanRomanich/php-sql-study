<?php
session_start();
include_once('./dbconnect.php');

#Проверка условия и выполнение удаения поля
if (isset($_GET['remove']) && $_GET['remove']) {
    $t_field = $_GET['t_field'];
    $t_name = $_GET['t_name'];
    $sql_remove = $db->prepare('ALTER TABLE `'.$t_name.'` '.'DROP `'.$t_field.'`');
    $sql_remove->execute();
    header("Location: ./form_table.php?t_name=".$t_name);
}

#Проверка условия и изменение имени и типа поля
if (isset($_GET['change']) && $_GET['change']) {
    $t_name = $_GET['t_name'];
    if ($_GET['field_old'] == $_GET['field_new'] && $_GET['type_old'] == $_GET['type_new']) {
        header("Location: ./form_table.php?t_name=".$t_name);
        exit;
    }
    $field_old = $_GET['field_old'];
    $field_new = $_GET['field_new'];
    $type_old = $_GET['type_old'];
    $type_new = $_GET['type_new'];

    $sql_change = $db->prepare('ALTER TABLE `'.$t_name.'` '.'CHANGE `'.$field_old.'` `'.$field_new.'` '.$type_new);
    $sql_change->execute();
    header("Location: ./form_table.php?t_name=".$t_name);
}
?>