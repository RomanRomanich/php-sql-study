<?php 
    $questArray = json_decode(file_get_contents('./files/test.json'), true);
 ?>



<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <p><?php print_r('Количество имеющихся тестов '.count($questArray)); ?></p>
    <p>Введите номер теста</p>
    <form action="test.php" method="GET">
        <input type="text" name="testNumber" >
        <input type="submit" value="Перейти к выбранному тесту">
    </form>
</body>
</html>
