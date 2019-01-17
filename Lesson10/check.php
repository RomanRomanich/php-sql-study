<?php
session_start();
#Предотвращение входа по прямому запросу (возврат в начало если не определены БД пользователь и пароь к ней
if (empty($_SESSION['dbUser']) || empty($_SESSION['dbPass']) || empty($_SESSION['dbName'])) {
    header('Location: index.php');
}

$db = new PDO('mysql:host=localhost;dbname='.$_SESSION['dbName'].';charset=UTF8', $_SESSION['dbUser'], $_SESSION['dbPass']);


$loginCheckQuery = $db->prepare("SELECT * FROM `user` WHERE login = :login");
$loginCheckQuery->execute([":login" => $_POST['user']]);
$loginCheck = $loginCheckQuery->fetch(PDO::FETCH_ASSOC);
#var_dump($loginCheck);
if (password_verify($_POST['pass'], $loginCheck['password'])) {
    $_SESSION['userID'] = $loginCheck['id'];
    header('Location: main.php');
    #echo '<br>';
    #var_dump($_SESSION['userID']);

}

?>

<a href="index.php">перейти назад</a>
