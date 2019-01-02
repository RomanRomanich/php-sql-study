<?php 
    foreach (scandir('./files') as $value) {
        if (stristr($value, '.json') !== false) {
            $questArray[] = $value;
        }
    }
 ?>



<!DOCTYPE html>
<html>
<head>
    <title>Урок пятый. Обработка форм.</title>
</head>
<body>
    <?php foreach ($questArray as $key => $value): ?>
        <p><a href=<?php echo './test.php?testNumber='.($key+1); ?>><?php echo $value; ?></a></p>
    <?php endforeach ?>
</body>
</html>
