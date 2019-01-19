<?php
session_start();
#Предотвращение входа по прямому запросу (возврат в начало если не определены БД пользователь и пароь к ней и нет авторизации
if (empty($_SESSION['dbUser']) || empty($_SESSION['dbPass']) || empty($_SESSION['dbName']) || empty($_SESSION['userID'])) {
    header('Location: index.php');
}
$db = new PDO('mysql:host=localhost;dbname='.$_SESSION['dbName'].';charset=UTF8', $_SESSION['dbUser'], $_SESSION['dbPass']);

#Смена пользователя
if (!empty($_POST['user_change']) && $_POST['user_change']) {
    unset($_SESSION['userID']);
    unset($_POST['user_change']);
    header('Location: index.php');
}

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
    $taskInsertQuery = $db->prepare("INSERT INTO `task`(`id`, `user_id`, `assigned_user_id`, `description`, `is_done`, `date_added`) VALUES (NULL, :user_id, :user_id, :description, 0, :date_added )");
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

#Делегирование задач
if (isset($_POST['assignUser'])) {
    $taskUpdateStatusQuery = $db->prepare("UPDATE `task` SET assigned_user_id = :assigned_user_id WHERE id = :id AND user_id = :user_id");
    $taskUpdateStatusQuery->execute([":assigned_user_id" => $_POST['assignUser'], ":id" => $_POST['update_id'], ":user_id" => $_SESSION['userID']]);
    $_POST['assignUser'] = NULL;
}

#Получение перечня задач
$taskCheckQuery = $db->prepare("SELECT * FROM `task` WHERE user_id = :user_id OR assigned_user_id = :user_id ORDER BY `date_added`");
$taskCheckQuery->execute([":user_id" => $_SESSION['userID']]);
$tasks = $taskCheckQuery->fetchAll(PDO::FETCH_ASSOC);

#Получение всего списка пользователей
$allUserQuery = $db->prepare("SELECT `id`, `login` FROM `user`");
$allUserQuery->execute();
$allUsers = $allUserQuery->fetchAll(PDO::FETCH_ASSOC);

#Получение количества задач
$taskCountQuery = $db->prepare("SELECT COUNT(*) FROM `task` WHERE user_id = :user_id OR assigned_user_id = :user_id");
$taskCountQuery->execute([":user_id" => $_SESSION['userID']]);
$taskCount = $taskCountQuery->fetchAll(PDO::FETCH_COLUMN);

#Получение имен пользователей делегировавших задачи
$taskAuthorsQuery = $db->prepare("SELECT t.id as task_id, login, u.id as user_id FROM task t INNER JOIN USER u ON u.id = t.user_id WHERE t.user_id = :user_id OR t.assigned_user_id = :user_id");
$taskAuthorsQuery->execute(["user_id" => $_SESSION['userID']]);
$taskAuthors = $taskAuthorsQuery->fetchAll(PDO::FETCH_ASSOC);


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
    <input type="hidden" name="user_change" value="true">
    <input type="submit" value="Выйти">
</form>
<form action="" method="POST">
    <p>добавть новую задачу</p>
    <input type="text" name="description" required>
    <input type="submit">
</form>
<p>Всего задач <?= $taskCount[0] ?></p>
<table>
    <thead>
        <tr><td>Задача</td><td>Кодга добавлена</td><td>Кем добавлена(делегирована)</td><td>Выполнено/Невыполнено</td><td>Делегировать</td></tr>
    </thead>
    <tbody>
        <?php foreach($tasks as $tasksValue): ?>
            <tr>
                <td><?php echo $tasksValue['description']; ?></td>
                <td><?php echo $tasksValue['date_added']; ?></td>
                <td>
                    <?php
                    foreach ($taskAuthors as $author) {
                        if ($author['task_id'] == $tasksValue['id']) {
                            if ($author['user_id'] == $_SESSION['userID']) {
                                echo "Это моя задача";
                            } else {
                                echo "А эту задачу подкинул ".$author['login'];
                            }

                        }
                    }?>
                </td>
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
                        <input type="hidden" name="update_id" value="<?php echo $tasksValue['id'] ?>">
                        <select name="assignUser">
                            <?php foreach ($allUsers as $allUsersKey => $allUserValue): ?>
                                <option value="<?php echo $allUserValue['id'];?>" <?php if ($tasksValue['assigned_user_id'] == $allUserValue['id']) { echo "selected"; }?> > <?php echo $allUserValue['login'];?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="submit" value="Делегировать">
                    </form>
                    <p><?php if ($tasksValue['user_id'] != $_SESSION['userID']) {echo "Тебе поручили? Вот и нечего стрелки переводить";} ?></p>
                </td>
                <td>
                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?php echo $tasksValue['id']?>">
                        <input type="submit" value="Удалить"> <?php if ($tasksValue['user_id'] != $_SESSION['userID']) {echo "Удалить не получится, не ты создавал";} ?>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>

</body>
</html>
