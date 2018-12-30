<?php 
    foreach (scandir('./files') as $key => $value) {
        if (stristr($value, '.json') !== false) {
            $questArray[] = $value;
        }
    }
 ?>



<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <p><?php echo 'Количество имеющихся файлов тестов '.count($questArray); ?></p>
    <p><a href="./test.php">Перейти к тестам</a></p>
</body>
</html>
