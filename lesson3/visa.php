<?php
#Изучаем полученные параметры

	if ($argc <= 1) {
		echo "Не введено название страны";
		exit;
	}

	$countryName = $argv[1];
	
#Проверяем фал на наличие и загружаем его

	$visaFile = @fopen("https://data.gov.ru/opendata/7704206201-country/data-20180609T0649-structure-20180609T0649.csv", "r");
	if ($visaFile == FALSE) {
		echo "Файла не существует, либо файл временно не доступен, повторите запрос позднее";
		exit;
	};

	
#Грузим файл в массив и закрываем файл
	$i = 0;
	while ($visaArray[$i] = fgetcsv($visaFile,",")) {
		$i++;
	}
	fclose($visaFile);
	array_shift($visaArray);
	array_pop($visaArray);
	#print_r($visaArray);


# Считаем расстояние Левенштейна
	foreach ($visaArray as $visaString) {
		$visaLevenshtein[] = $visaString[1];
	}

	foreach ($visaLevenshtein as $name) {
		if (levenshtein($countryName, $name) <= 3) {
			
			$countryName = $name;
			break;
		}

	}
# Собственно поиск нужной страны и режима въезда
	foreach($visaArray as $key => $visaString) {
		if ($visaString[1] == $countryName){
			echo $visaString[1] . ": ". $visaString[4];
			echo PHP_EOL;
			exit;
		} 		
	};

	echo "А вы уверены что такая страна существует?\nКстати название страны имя собственное и должно писаться с большой буквы.\nПопробуйте еще раз.";
?>