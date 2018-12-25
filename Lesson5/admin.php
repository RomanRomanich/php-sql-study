<?php 
   $upload = move_uploaded_file($_FILES['fileName']['tmp_name'], "./files/test.json");
   if(!$upload) {
    echo 'Файл загрузить не удалось, наверно какая-то ошибка';
   }
   echo "<a href=".$_SERVER['HTTP_ORIGIN']."> Вернуться на стартовую страницу</a>";
?>

