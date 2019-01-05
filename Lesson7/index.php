<?php
    //Проверка наличия куки "отдыха"
    session_start();
    if (isset($_COOKIE['tryLater']) && $_COOKIE['tryLater']) {
        http_response_code('403');
        echo 'Даже роботы устают. Отдохните';
        exit;
    }

    //Установка счетчика попыток входа
    if (!isset($_POST['counterStart'])) {
        $_SESSION['tryCounter'] = 0;
    }

    //Установка счетчика попыток ввода капчи
    if (!isset($_POST['expression'])) {
        $_SESSION['tryCapcha'] = 0;
    }

    #var_dump($_SESSION);

    //увеличение счетчика неудачной капчи
    if (isset($_POST['expression']) && isset($_SESSION['expression']) && ($_SESSION['expression'] != $_POST['expression'])) {
        $_SESSION['tryCapcha']++;
    }

    //блокировка входа из-за превышения попыток входа и обнуление счетчиков
    if ($_SESSION['tryCounter'] >= 12 || $_SESSION['tryCapcha'] >= 5) {
        echo setcookie("tryLater",'true', time()+3600);
        $_SESSION['tryCounter'] = 0;
        $_SESSION['tryCapcha'] = 0;
        unset($_POST['counterStart']);
        echo 'Все же вы робот. Ну или очень устали. В любом случае отдохние часок';
        echo '<br>';
        print_r($_COOKIE);
        exit;
    }

    //загрузка файла с паролями
    $logins = json_decode(file_get_contents('./logins.json'), true);

    //блок проверки введенных логинов и паролей и авторизация
    if(isset($_POST['userPass']) && array_key_exists($_POST['userName'], $logins)) {
        if($logins[$_POST['userName']] == $_POST['userPass']) {
            $_SESSION['admin'] = 'true';
            $_SESSION['humanName'] = $_POST['userName'];
            $_SESSION['tryCounter'] = 0;
            header("Location: list.php");
            echo 'поздравляю вы авторизовались с админскими правами';
        } else {
            echo 'Не правильные логин/пароль';
            $_SESSION['tryCounter']++;
            if (isset($_SESSION['admin'])) {
                $_SESSION['admin'] = false;
            }
        }
    } elseif ( !empty($_POST['userName']) && empty($_POST['userPass']) ) {
        $_SESSION['humanName'] = $_POST['userName'];
        $_SESSION['admin'] = false;
        $_SESSION['tryCounter'] = 0;
        header("Location: list.php");
        echo 'получен гостевой доступ';
        
    } else {
        $_SESSION['tryCounter']++;
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Урок 7. Куки, сессии, авторизация.</title>
</head>
<body>

    <?php if (empty($_SESSION['tryCounter']) || $_SESSION['tryCounter'] <= 6): ?>
        <p>Авторизуйтесь, указав имя пользователя и пароль, либо зайдите с гостевым доступом, указав только имя.</p>
        <form action="" method="post">
            <input type="hidden" name="counterStart" value="true">
            <legend>Введите имя
                <p><input type="text" name="userName"></p>
            </legend>
            <legend> Введите пароль
                <p><input type="password" name="userPass"></p>    
            </legend>    
            <p><input type="submit" value="Автризоваться"></p>
        </form>
    <?php elseif ($_SESSION['tryCounter'] >= 7): ?>
        <p>Авторизуйтесь, указав имя пользователя и пароль, либо зайдите с гостевым доступом, указав только имя. И введите капчу, если вы не робот.</p>

        <form action="" method="post">
            <input type="hidden" name="counterStart" value="true">
            <legend>Введите имя
                <p><input type="text" name="userName"></p>
            </legend>
            <legend>Введите пароль
                <p><input type="password" name="userPass"></p>    
            </legend>
            <legend>Введите капчу
                <input type="text" required name="expression"><img src="capcha.php">
            </legend>
            <p><input type="submit" value="Автризоваться"></p>
        </form>
    <?php endif ?>

</body>
</html>