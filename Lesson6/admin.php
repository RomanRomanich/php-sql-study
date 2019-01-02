<?php
    $dir = scandir('./files');
    array_splice($dir, 0, 2);
    if(isset($_FILES['fileName'])) {
        $fileName = 'test'.date("ymdHis").'.json';
        $upload = move_uploaded_file($_FILES['fileName']['tmp_name'], "./files/".$fileName);
        if(!$upload) {
        echo 'Файл загрузить не удалось, наверно какая-то ошибка';
       } else {echo 'Файл загружен успешно';}
    }
    echo '<br/>';
   echo "<a href='list.php'> Перейти к списку тестов.</a>";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Урок пятый. Обработка форм</title>
</head>
<body>
    <form enctype="multipart/form-data" action="admin.php" method="post">
        <p><input type="file" multiple="" name="fileName"></p>
        <p><input type="submit" value="Загрузить файл"></p>
    </form>
</body>
</html>