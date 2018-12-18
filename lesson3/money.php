<?php
    $someText = $argv;

    if(($someText[1] == '--today') && $argc <= 2)  {
    	if($file = fopen("test.csv", "r")) {;
    		$i = 0;
    		$summaDeneg = 0;
    		while($fieldsArryay[$i] = fgetcsv($file,",")) {
    			$summaDeneg = $summaDeneg + $fieldsArryay[$i][1];
    			$i++;
    	
    		}
    		echo "Сегодня, ". date("Y-m-d") . ", было потрачено " . number_format($summaDeneg, 2). " денег.";
   			echo PHP_EOL;
   			exit;
   		}
   		echo "Такого файла не существует";
   		exit;
    }

     if($argc <= 2) {
    	echo 'Ошибка! Аргументы не заданы, или заданы не все. Укажите флаг --today или запустите скрипт с аргументами {цена} и {описание покупки}';
    exit;
	}

    array_shift($someText);				#убирается информация о имени файла
    $price = array_shift($someText);	#выдергивается информация о цене

    #собираем массив для записи

    $textToFile = [date("Y-m-d"), $price, implode(' ', $someText)];
    print_r($textToFile);

    $file = fopen("test.csv", "a+");	#открываем файл
    fputcsv($file, $textToFile);		#вкладываем полученную информацию в файл

?>