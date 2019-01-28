<?php
session_start();

include('./files/connect.php');

include('./files/categories.php');
include('./files/questions.php');

include('./files/controller.php');
unset($_POST);


/*$cats = new Categories();
$allCats = $cats->getAllCats();*/

//include('./user.php');

?>

<!--<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
</head>
<body>
<form action="" method="get">
    <p><a href="?admin=1">Войти как администратор</a></p>
    <p>просто текст</p>
<pre>
    <?php /*print_r($allCats); */?>
</pre>

    
</form>

</body>
</html>-->


