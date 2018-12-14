<?php 
	$myZoo = [
		'Africa' => ['Loxodonta', 'Hippopotamus amphibius'],
		'Europe' => ['Rupicapra rupicapra', 'Nemorhaedus goral', 'Moschus moschiferus', 'Capreolus capreolus'],
		'Antarctic' => ['Otariidae', 'Aptenodytes patagonicus'],
		'Australia' => ['Tachyglossus', 'Macropus'],
		'North America' => ['Rangifer tarandus', 'Heloderma suspectum'],
		'South America' => ['Dasyprocta','Myrmecophaga tridactyla']
	];

	foreach($myZoo as $c => $z) {
    	$country = $c;
	    foreach($z as $zver) {
	        if(stristr($zver, ' ')) {
    	    $newZoo[] = $zver;
        	}
    	}
	}

	unset($zver);

	foreach($newZoo as $zver) {
    	$firstName[] = substr ($zver, 0, strpos($zver, ' '));
    	$secondName[] = substr ($zver, strpos($zver, ' '));
    }

    shuffle($firstName);
    shuffle($secondName);
   	for($i=0; $i < count($newZoo); $i++) {
		$fantasyZoo[] = $firstName[$i] . ' ' . $secondName[$i];
	}

	
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		p {
			margin: 0 0 0 4em;
		}
	</style>
</head>
<body>
	<h1>Это главный зоопарк</h1>
	<p><?php print_r($myZoo)?></p>

	<h2>А здесь только те, кто с двойным названием</h2>
	<p>
		<?php 
		for ($i=0; $i < count($newZoo) - 1; $i++) {
			echo $newZoo[$i] . ', ';
		} 
		echo $newZoo[$i];
		?>
	</p>
	<h2>Привезли фентезийный зоопарк</h2>
	<?php for ($i=0; $i < count($fantasyZoo); $i++): ?>
	<p><?php print_r($fantasyZoo[$i])?></p>
	<?php endfor; ?>

</body>
</html>