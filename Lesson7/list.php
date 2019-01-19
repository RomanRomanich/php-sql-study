<?php
    session_start();
include_once ('./files/extra/autority_chech.php');
isUser();
    
    if (isset($_POST['sessionKill'])) {
        session_unset();
        session_destroy();
        header('Location: index.php');
    }

    if (isset($_POST['fileDelete'])) {
        foreach ($_POST['fileDelete'] as $key => $value) {
            unlink('files/'.$value);
        }
        unset($_POST['fileDelete']);
    }

    foreach (scandir('./files') as $value) {
        if (stristr($value, '.json') !== false) {
            $questArray[] = $value;
        }
    }
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>Урок 7. Куки, сессии, авторизация.</title>
</head>
<body>
    <form action="" method="post">
        <input type="hidden" name="sessionKill" value="true">
        <input type="submit" name="" value="Завершить сеанс">
    </form>

    <?php if (!isset($_SESSION['admin']) || !$_SESSION['admin']): ?>
        <?php foreach ($questArray as $key => $value): ?>
            <p><a href=<?php echo './test.php?testNumber='.($key+1); ?>><?php echo $value; ?></a></p>
        <?php endforeach ?>
    <?php endif ?>
    

    <?php if (isset($_SESSION['admin']) && $_SESSION['admin']): ?>
        <form action="" method="post">
            <?php $i = 0; foreach ($questArray as $key => $value): ?>
                <p><input type="checkbox" name="fileDelete[]" value=<?php echo $value ?>><a href=<?php echo './test.php?testNumber='.($key+1); ?>><?php echo $value; ?></a></p>
            <?php endforeach ?>
            <p><input type="submit" name="" value="Удалить"></p>
        </form>



        <a href="./admin.php">Перейти к загрузке тестов</a>
    <?php endif ?>
</body>
</html>
