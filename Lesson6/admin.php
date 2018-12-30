<?php
   if(count($_FILES) != 0) {
       $upload = move_uploaded_file($_FILES['fileName']['tmp_name'], "./files/".$_FILES['fileName']['name']);
       if(!$upload) {
        echo 'Файл загрузить не удалось, наверно какая-то ошибка';
       } else {header('Location: list.php');}
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Урок четвертый.</title>
</head>
<body>
    <form enctype="multipart/form-data" action="admin.php" method="post">
        <p><input type="file" multiple="" name="fileName"></p>
        <p><input type="submit" value="Загрузить файл"></p>
    </form>
</body>
</html>