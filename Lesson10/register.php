<?php
session_start();
#Предотвращение входа по прямому запросу (возврат в начало если не определены БД пользователь и пароь к ней
if (empty($_SESSION['dbUser']) || empty($_SESSION['dbPass']) || empty($_SESSION['dbName'])) {
    header('Location: index.php');
}

$db = new PDO('mysql:host=localhost;dbname='.$_SESSION['dbName'].';charset=UTF8', $_SESSION['dbUser'], $_SESSION['dbPass']);

#проверка уникальности логина и регистрация нового пользователя при успехе
if (!empty($_POST['user']) && !empty($_POST['pass'])) {
    $loginCheckQuery = $db->prepare("SELECT `id` FROM `user` WHERE login = :login");
    $loginCheckQuery->execute([":login" => $_POST['user']]);
    $loginCheck = $loginCheckQuery->fetchAll(PDO::FETCH_COLUMN);
    #var_dump($loginCheck);
    if (empty($loginCheck)) {
        $_POST['pass'] = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        $dbQuery = $db->prepare("INSERT INTO `user` (`id`, `login`, `password`) VALUE (NULL, :usr, :pass)");
        $ok = $dbQuery->execute([":usr" => $_POST['user'], ":pass" => $_POST['pass']]);
        if ($ok) {
            header('Refresh: 3; url=index.php');
            echo "успешно заргеистрировался";
            exit;
        } else {
            header('Refresh: 3; url=index.php');
            echo "какая-то ошибка";
        }
    } else {
        echo "Введенный логин уже существует";
    }
}
?>


<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
    <p>Логин<input type="text" name="user" required></p>
    <p>Пароль<input type="text" name="pass" required></p>
    <p><input type="submit" value="зарегистрироваться"></p>
</form>
</body>
</html>
