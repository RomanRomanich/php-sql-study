<?php
$phoneBook = json_decode(file_get_contents('test.json'),true);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Домашка №4 по работе с JSON файлами</title>
  </head>
  <body>
    <table>
      <tr>
          <td>Имя</td>
          <td>Фамилия</td>
          <td>Адрес</td>
          <td>Телефон</td>
      </tr>
      
      <?php foreach ($phoneBook as $listing): ?>
        <tr>
        <td> <?php echo $listing['firstName']; ?></td>
        <td> <?php echo $listing['lastName']; ?></td>
        <td> <?php echo $listing['address']; ?></td>
        <td> <?php echo $listing['phoneNumber']; ?></td>
        </tr>
        <?php endforeach; ?>

    </table>
  </body>
</html>