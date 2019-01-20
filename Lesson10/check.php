<?php
session_start();
#Предотвращение входа по прямому запросу (возврат в начало если не определены БД пользователь и пароь к ней
if (empty($_SESSION['dbUser']) || empty($_SESSION['dbPass']) || empty($_SESSION['dbName'])) {
    header('Location: index.php');
}

include_once ('dbconnect.php');


$loginCheckQuery = $db->prepare("SELECT * FROM `user` WHERE login = :login");
$loginCheckQuery->execute([":login" => $_POST['user']]);
$loginCheck = $loginCheckQuery->fetch(PDO::FETCH_ASSOC);

if (password_verify($_POST['pass'], $loginCheck['password'])) {
    $_SESSION['userID'] = $loginCheck['id'];
    header('Location: main.php');
}
?>
<p>Такого пользователя не существует.  <a href="index.php">Попробуйте еще раз.</a></p>