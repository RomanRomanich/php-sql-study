<?php
    foreach (scandir('./files') as $key => $value) {
        if (stristr($value, '.json') !== false) {
            $questArray[] = $value;
        }
    }
    unset($value);
        
    if (array_key_exists('testNumber', $_GET)) {
        $reqNumber = ($_GET['testNumber'] - 1);
        $testPrep = json_decode(file_get_contents('./files/'.$questArray[$reqNumber]), 384);
    }
    
    if (isset($_GET['testPassed'])) {
        echo 'Результаты тестирования:';
        array_shift($_GET);
        array_shift($_GET);
        $ansArray = $_GET;
        $rightAnsvers = 0;
        foreach ($testPrep as $key => $value) {
            if ($value['ans'][$ansArray[$key]][1] == 'true') {
            $rightAnsvers++;
            }
        }
        echo '<br>';
        echo 'Правильных ответов '.$rightAnsvers.' из '. count($testPrep);
        echo '<br>';
        unset($testPrep);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Все еще урок 4</title>
</head>
<body>
   
    <?php if ((!array_key_exists('testNumber', $_GET)) && ((!array_key_exists('testPassed', $_GET)) || ($_GET['testPassed'] != 'true'))): ?>
        <p><?php echo 'Количество имеющихся файлов тестов '.count($questArray); ?></p>
        <p>Введите номер теста</p>
        <form action="test.php" method="GET">
            <input type="text" name="testNumber" >
            <input type="submit" value="Перейти к выбранному тесту">
        </form>
    <?php endif; ?>


    <?php if (isset($testPrep) && !array_key_exists('testPassed', $_GET)): ?>
        <p>Вопросы теста № <?php echo $reqNumber +1; ?></p>
        <form method="GET">
        <input type="hidden" name="testPassed" value="true">
        <input type="hidden" name="testNumber" value=<?php echo $reqNumber +1; ?> >
            <?php foreach ($testPrep as $key => $value): ?>

                <p><?php echo $value['quest'] ?></p>

                <?php foreach ($value['ans'] as $keyAnsver => $valueAnsver): ?>
                    <input type="radio" name=<?php echo $key ?> value=<?php echo $keyAnsver ?>><?php echo $valueAnsver[0] ?>
                <?php endforeach; ?>

            <?php endforeach; ?>
            <p><input type="submit"></p>
        </form>
   <?php endif ?>
  
</body>
</html>

<?php
/*if (isset($_GET['testPassed'])) {
    echo 'Результаты тестирования:';
    array_shift($_GET);
    array_shift($_GET);
    $ansArray = $_GET;
    $rightAnsvers = 0;
    foreach ($testPrep as $key => $value) {
        if ($value['ans'][$ansArray[$key]][1] == 'true') {
            $rightAnsvers++;
        }
    }
    echo '<br>';
    echo 'Правильных ответов '.$rightAnsvers.' из '. count($testPrep);

}*/
?>