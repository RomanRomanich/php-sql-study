<?php
#Проверка авторизации
function isAdmin () {
    if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
        header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
        echo 'Ошибка 403. Требуется авторизация';
        echo '</br>';
        echo "<a href='index.php'>Перейти на страницу авторизации.</a>";
        exit;
    }
}

function isUser () {
    if (empty($_SESSION['humanName'])) {
        header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
        echo 'Ошибка 403. Требуется авторизация';
        echo '</br>';
        echo "<a href='index.php'>Перейти на страницу авторизации.</a>";
        exit;
    }
}
?>