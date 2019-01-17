<?php
session_start();
#Предотвращение входа по прямому запросу (возврат в начало если не определены БД пользователь и пароь к ней и нет авторизации
if (empty($_SESSION['dbUser']) || empty($_SESSION['dbPass']) || empty($_SESSION['dbName']) || empty($_SESSION['userID'])) {
    header('Location: index.php');
}
$db = new PDO('mysql:host=localhost;dbname='.$_SESSION['dbName'].';charset=UTF8', $_SESSION['dbUser'], $_SESSION['dbPass']);

#Удаление задачи
if (!empty($_POST['id'])) {
    $taskDeleteQuery = $db->prepare("DELETE FROM `task` WHERE id = :id AND user_id = :user_id LIMIT 1");
    $taskDeleteQuery->execute([":id" => $_POST['id'], ":user_id" => $_SESSION['userID']]);
    unset($_POST['id']);
    #header("Refresh: 0; url=main.php");
}

#добавление нового дела
if (!empty($_POST['description'])) {
    $date = date('Y-m-d H:i:s');
    print_r($date);
    $taskInsertQuery = $db->prepare("INSERT INTO `task`(`id`, `user_id`, `assigned_user_id`, `description`, `is_done`, `date_added`) VALUES (NULL, :user_id, NULL, :description, 0, :date_added )");
    $taskInsertQuery->execute([":user_id" => $_SESSION['userID'], ":description" => $_POST['description'], ":date_added" => $date]);
    $_GET['description'] = NULL;
    header("Refresh: 0; url=main.php");
}

#Смена статуса документа
if (isset($_POST['is_done'])) {
    $taskUpdateStatusQuery = $db->prepare("UPDATE `task` SET is_done = :is_done WHERE id = :id AND user_id = :user_id");
    $taskUpdateStatusQuery->execute([":is_done" => $_POST['is_done'], ":id" => $_POST['update_id'], ":user_id" => $_SESSION['userID']]);
    $_POST['is_done'] = NULL;
}

#Получение перечня задач
$taskCheckQuery = $db->prepare("SELECT * FROM `task` WHERE user_id = :user_id OR assigned_user_id = :user_id ORDER BY `date_added`");
$taskCheckQuery->execute([":user_id" => $_SESSION['userID']]);
$tasks = $taskCheckQuery->fetchAll(PDO::FETCH_ASSOC);

#Получение всего списка пользователей
$allUserQuery = $db->prepare("SELECT `id`, `login` FROM `user`");
$allUserQuery->execute();
$allUsers = $allUserQuery->fetchAll(PDO::FETCH_ASSOC);




?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>список дел</title>
    <style type="text/css">
        table {
            margin-top: 15px;
            border-collapse: collapse;
        }
        thead tr {
            font-weight: bold;
            background-color: #a9a9a9;
        }
        tbody tr:nth-child(even) {
            background-color: lightgrey;
        }
        td {
            padding: 3px;
            border-width: 1px;
            border-style: solid;
            border-color: #cccccc;
        }
        .inputline {
            display: inline-block;
        }
    </style>
</head>
<body>
<form action="" method="POST">
    <p>добавть новую задачу</p>
    <input type="text" name="description" required>
    <input type="submit">
</form>

<table>
    <thead>
        <tr><td>Задача</td><td>Кодга добавлена</td><td>Выполнено/Невыполнено</td><td>Делегировать</td></tr>
    </thead>
    <tbody>
        <?php foreach($tasks as $tasksValue): ?>
            <tr>
                <td><?php echo $tasksValue['description']; ?></td>
                <td><?php echo $tasksValue['date_added']; ?></td>
                <td><?php if ($tasksValue['is_done']){
                        $status = 'Выполнено';
                        $buttonValue = 'Вернуть в работу';
                    } else {
                        $status = 'В работе';
                        $buttonValue = 'Закрыть';
                    }
                    echo $status ?>
                    <form class="inputline" action="" method="POST">
                        <input type="hidden" name="is_done" value="<?php if ($tasksValue['is_done']) {
                                                                            echo 0;
                                                                         } else {
                                                                            echo 1;} ?>">
                        <input type="hidden" name="update_id" value="<?php echo $tasksValue['id'] ?>">
                        <input type="submit" value="<?php echo $buttonValue ?>">
                    </form>
                </td>
                <td>


                    <form action="" method="post">
<!--                        --><?php //print_r($tasksValue['user_id']); ?>
                        <select name="" id="">
                        <?php if ($tasksValue['user_id'] == $_SESSION['userID']): ?>
<!--                        <select name="" id="">-->
                            <?php foreach ($allUsers as $allUsersKey => $allUserValue): ?>
                                <option value="" disabled><?php echo $allUserValue['login'] ?></option>
                            <?php endforeach; ?>
<!--                        </select>-->
                        <?php else: ?>
<!--                        <select name="" id="" disabled>-->
                            <?php foreach ($allUsers as $allUsersKey => $allUserValue): ?>
                            <option value="" ><?php echo $allUserValue['login'] ?></option>
                            <?php endforeach; ?>
                        </select>
                            <?php endif; ?>

                    </form>




                </td>
                <td>
                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?php echo $tasksValue['id']?>">
                        <input type="submit" value="Удалить">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>

<!--<select name="" id="">-->
<?php //foreach ($allUsers as $allUsersKey => $allUserValue): ?>
<!--    <option value="" >--><?php //echo $allUserValue['login'] ?><!--</option>-->
<?php //endforeach; ?>
<!--</select>-->


</body>
</html>
