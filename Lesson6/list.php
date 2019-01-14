<?php
    foreach (scandir('./files') as $value) {
        if (stristr($value, '.json') !== false) {
            $questArray[] = $value;
        }
    }
    if (empty($questArray)) {
        echo "судя по всему нету еще ни одного файла теста \n";
        echo "<a href='admin.php'> Перейти к загрузке тестов.</a>";
        exit;
    }
 ?>



<!DOCTYPE html>
<html>
<head>
    <title>Урок шестой. PHP и HTTP.</title>
</head>
<body>
    <?php foreach ($questArray as $key => $value): ?>
        <p><a href=<?php echo './test.php?testNumber='.($key+1); ?>><?php echo $value; ?></a></p>
    <?php endforeach ?>
</body>
</html>
