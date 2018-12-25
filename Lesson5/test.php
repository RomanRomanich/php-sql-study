<?php
    $reqNumber = ($_GET['testNumber'] - 1);
    $testPrep = json_decode(file_get_contents('files\test.json'), 384);
 ?>

 <!DOCTYPE html>
 <html>
 <head>
     <title>Все еще урок 4</title>
 </head>
 <body>
    <p>Вопросы теста № <?php echo $reqNumber +1; ?></p>
    <form method="GET">
        <input type="hidden" name="testNumber" value= <?php print_r($_GET['testNumber']); ?> >
        <?php foreach ($testPrep[$reqNumber] as $key => $value): ?>        
            <p><?php print_r($value['quest']); ?></p>
            <input type="radio" name=<?php print_r($key);?> value="ans1"><?php print_r($value['ans1'][0]); ?>
            <input type="radio" name=<?php print_r($key);?> value="ans2"><?php print_r($value['ans2'][0]); ?>
            <input type="radio" name=<?php print_r($key);?> value="ans3"><?php print_r($value['ans3'][0]); ?>
        <?php endforeach; ?>
        <p><input type="submit" name=""></p>
            
        </form>
  
 </body>
 </html>

<?php
if (isset($_GET[$key])) {
    echo 'Результаты тестирования:';
    echo '<br>';
    foreach ($testPrep[$reqNumber] as $key => $value) {
        if ($value[$_GET[$key]][1] === 'true') {
            echo '<br>';
            echo "Ответ на вопрос ";
            print_r($value['quest']);
            echo " правильный";
        } else {
            echo '<br>';
            echo "Ответ на вопрос ";
            print_r($value['quest']);
            echo " не правильный";
        }
    }
}
?>