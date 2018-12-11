<?php
    
    $name = 'Roman';
    $age = 37;
    $mail = 'RomanB4@yandex.ru';
    $city = 'Sevastopol';
    $someInfo = 'Родился, вырос, учился';
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
	    <title>Это я</title>
	    <meta charset="utf-8">
    </head>

    <body>
        <h1>Это вроде моя страница</h1>
        <dl>
        	<dt>Меня зовут</dt>
        	<dd><?php echo $name;?></dd>
        	<dt>Мне</dt>
        	<dd><?php echo $age;?> лет</dd>
        	<dt>Моя почта</dt>
        	<dd><?php echo $mail;?></dd>
        	<dt>Я живу</dt>
        	<dd><?php echo $city;?></dd>
        	<dt>Коротко о себе</dt>
        	<dd><?php echo $someInfo;?></dd>
        </dl>
    </body>
</html>