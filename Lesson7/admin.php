<?php
    session_start();
    #Проверка полномочий
    if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
        header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
        echo 'Ошибка 403. Требуется авторизация';
        echo '</br>';
        echo "<a href='index.php'>Перейти на страницу авторизации.</a>";
        exit;
    }
    #Секция загрузки файла
    $dir = scandir('./files');
    array_splice($dir, 0, 2);
    if(isset($_FILES['fileName'])) {
        $fileName = 'test'.date("ymdHis").'.json';
        $upload = move_uploaded_file($_FILES['fileName']['tmp_name'], "./files/".$fileName);
        /*if(!$upload) {
        echo 'Файл загрузить не удалось, наверно какая-то ошибка';
       } else {echo 'Файл загружен успешно';}*/
    }
    #echo '<br/>';
    #echo "<a href='list.php'> Перейти к списку тестов.</a>";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Урок 7. Куки, сессии, авторизация.</title>
</head>
<body>

    <?php if (isset($upload) && !$upload): ?>
        <p>Файл загрузить не удалось, наверно какая-то ошибка</p>
    <?php endif ?>
    
    <?php if (isset($upload) && $upload): ?>
        <p>Файл загружен успешно</p>
    <?php endif ?>

    <p>Выберите файл для загрузки</p>
    <form enctype="multipart/form-data" action="admin.php" method="post">
        <p><input type="file" multiple="" name="fileName"></p>
        <p><input type="submit" value="Загрузить файл"></p>
    </form>

    <p><a href='list.php'> Перейти к списку тестов.</a></p>
</body>
</html>