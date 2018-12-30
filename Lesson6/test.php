<?php
    #Формирование массива с имеющимися файлами тестов
    foreach (scandir('./files') as $key => $value) {
        if (stristr($value, '.json') !== false) {
            $questArray[] = $value;
        }
    }
    unset($value);
    
    #Проверка правильности введенного номера теста
    if (array_key_exists('testNumber', $_GET)) {
        if ($_GET['testNumber'] > count($questArray) || !is_numeric($_GET['testNumber'])) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 404 not found');
            echo 'Вы указали некорректный номер теста. Попробукйте еще раз';
            array_shift($_GET);
        } else {
            $reqNumber = ($_GET['testNumber'] - 1);
            $testPrep = json_decode(file_get_contents('./files/'.$questArray[$reqNumber]), 384);
        }
    }
    #Подсчет правильных ответов тестов
    if (isset($_GET['testPassed'])) {
        echo 'Результаты тестирования:';
        $humanName = $_GET['humanName'];
        $testPassed = $_GET['testPassed'];
        $ansArray = array_slice($_GET, 3);
        array_splice($_GET, 0, 3);
        $rightAnsvers = 0;
        foreach ($testPrep as $key => $value) {
            if ($value['ans'][$ansArray[$key]][1] == 'true') {
            $rightAnsvers++;
            }
        }
        session_start();
        $_SESSION['humanName'] = $humanName;
        $_SESSION['rightAnsvers'] = $rightAnsvers;
        $_SESSION['maxAnsver'] = count($testPrep);
        
        unset($testPrep);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Все еще урок 4</title>
</head>
<body>

    <!-- А тут вывод картинки с сертификатом -->
    <?php if (isset($testPassed)): ?>
        <p><img src="cert.php"></p>
        <?php unset($testPassed); ?>
    <?php endif ?>


    <!-- Форма для получения номера теста    -->
    <?php if ((!array_key_exists('testNumber', $_GET)) && ((!array_key_exists('testPassed', $_GET)) || ($_GET['testPassed'] != 'true'))): ?>
        <p><?php echo 'Количество имеющихся файлов тестов '.count($questArray); ?></p>
        <p>Введите номер теста</p>
        <form action="test1.php" method="GET">
            <input type="text" name="testNumber" >
            <input type="submit" value="Перейти к выбранному тесту">
        </form>
    <?php endif; ?>

    <!-- Форма для вывода номера теста и получения ответов теста    -->
    <?php if (isset($testPrep) && !array_key_exists('testPassed', $_GET)): ?>
        <form method="GET">
        <p>Введите Ваше имя</p>
        <input type="text" name="humanName">
        <p>Вопросы теста № <?php echo $reqNumber +1; ?></p>
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
