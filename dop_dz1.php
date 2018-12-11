<!DOCTYPE html>
<html lang="ru">
<head>
	<title>дополнительно занятие</title>
	<meta charset="utf-8">
</head>
<body>
	Пользователь, введи число
	<form>
		<input type="field" name="number">
		<input type="submit" name="ввести">
	</form>
</body>

<?php 
	$user = $_GET['number'];
	$perem1 = 1;
	$perem2 = 1;
	$i = 0;
	
	while ($i <= 0) {
		if ($perem1 > $user) {
			echo $user . ' ' . 'Задуманное число НЕ входит в числовой ряд';
			$i++;
			break;
		}

		if ($perem1 == $user) {
			echo $user . ' ' . 'Задуманное число входит в числовой ряд';
			$i++;
			break;
		}

		$perem3 = $perem1;
		$perem1 = $perem1 + $perem2;
		$perem2 = $perem3;
				
	}
?>
</html>

