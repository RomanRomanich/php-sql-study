<?php
session_start();
if (empty($_SESSION['admin']) || $_SESSION['admin'] != 1) {
    header('Location: ../../index.php');
}
print_r($_SESSION);
echo 'Секция для админов';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<a href="../../index.php?admin=0">  Выйти</a>
</body>
</html>
