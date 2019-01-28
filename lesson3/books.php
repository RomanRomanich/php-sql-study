<?php
	#Проверка на наличе названия книги для поиска
    if ($argc <= 1) {
		echo "Не введено название книги";
		exit;
	}
	#Подготовка запроса  
	array_shift($argv); 			#избавляюсь от ненужных элементов
    $serchItem = implode(' ', $argv);  #Массив в строку

    #Убираю возможные пробелы из переменной для запроса, выполняю запрос и разбираю json
    $bookJson = json_decode(file_get_contents('https://www.googleapis.com/books/v1/volumes?q='.urlencode($serchItem)), true);

    #Проверяю наличие книг по запросу
    if ($bookJson['totalItems'] <= 0) {
    	echo 'Не нашлось ни одной книги по запросу';
    	exit;
    }

    $i = 0;
   	foreach ($bookJson['items'] as $k1 => $v1) {
  		$forCSV[$i]['id'] = $v1['id'];
  		$list = $v1;

  	  	foreach ($list as $k2 => $v2) {
  	  		if(is_array($v2) && array_key_exists('title', $v2)) {
  			$forCSV[$i]['title'] = $v2['title'];
  			}
  			if(is_array($v2) && array_key_exists('authors', $v2)) {
  				if (is_array($v2['authors'])) {
  					$forCSV[$i]['authors'] = implode(", ", $v2['authors']);
  				} else {
  					$forCSV[$i]['authors'] = $v2['authors'];
  				}

  			}

  		}
  	
  		$i++;
  	}
#print_r($forCSV);
$csvFile = fopen('testbooks.csv', 'w');

foreach ($forCSV as $field) {
	fputcsv($csvFile, $field);
}


?>