<?php
session_start();

include('autoload.php'); //Автозагрузка классов

$db = new Db(); //инициализация доступа к БД

//Проверка состояния правил доступа (админ или простой пользователь
if (empty ($_SESSION['admin']) || (isset($_GET['admin']) && $_GET['admin'] == 0)) {
    $_SESSION['admin'] = 0;
}

//  Пользовательсая секция
if($_SESSION['admin'] == 0) {
    $user = new \Controllers\UserController($db);
    //вход в админскую часть
    if (isset($_GET['admin']) && $_GET['admin'] == 1) {
        $user ->signin();
    }
    //Форма добавления нового фопроса
    if (isset($_POST['add_quest']) && $_POST['add_quest'] == 1) {
        $user->addQuestion($_POST);
    }
    //Загрузка главной страницы
    if (empty($_GET['admin']) || $_GET['admin'] != 1) {
        $user->mainPage();
    }

}

//  АДминская секция
if ($_SESSION['admin'] == 1) {
    $admin = new \Controllers\AdminController($db);
    //Вход в главное меню админской части
    if (empty($_GET['service']) || (isset($_GET['service'])) && $_GET['service'] == 'main') {
        $admin->mainPage();
    }
// Секция маршрутизации
    //Работа с учетками
    if (isset($_GET['service']) && $_GET['service'] == 'user') {
        //Удаление учетки
        if (isset($_GET['action']) && $_GET['action'] == 'delete') {
            $admin->userDelete();
        } //Добавление учетки
        elseif (isset($_GET['action']) && $_GET['action'] == 'add') {
            $admin->userAdd();
            $admin->showUser();
        } //Смена пароля
        elseif (isset($_GET['action']) && $_GET['action'] == 'pass_change') {
            $admin->passChange();
            $admin->showUser();
        } //Отображение всех учетных записей
        else {
            $admin->showUser();
        }
    } //Секция работы с категориями вопросов (темами)
    elseif (isset($_GET['service']) && $_GET['service'] == 'categories') {
        //Добавление
        if (isset($_GET['action']) && $_GET['action'] == 'add') {
            $admin->addCat();
        }
        //Удаление категорий и всех вопросов и ответов связанных с ней
        if (isset($_GET['action']) && $_GET['action'] == 'delete') {
            $admin->deleteCats();
        }
        //Переименование
        if (isset($_GET['action']) && $_GET['action'] == 'rename') {
            $admin->renameCat();
        }
        //Список категорий
        $admin->showAllCats();
    } //Отображение всех вопрос без ответов
    elseif (isset($_GET['service']) && $_GET['service'] == 'q_no_ans') {
        //Удаление вопроса
        if (isset($_GET['action']) && $_GET['action'] == 'delete') {
            $admin->deleteQuest();
        }
        //Внесние правок в вопрос
        if (isset($_GET['action']) && $_GET['action'] == 'quest_change') {
            $admin->changeQuest();
        }
        //Добавление ответа
        if (isset($_GET['action']) && $_GET['action'] == 'ansver_add') {
            $admin->addAnswer();
        }
        //список вопрос без ответов
        $admin->q_no_ans();
    } //Вопрсы разнесенные покатегориям
    elseif (isset($_GET['service']) && $_GET['service'] == 'q_and_ans') {
        //удаление вопроса
        if (isset($_GET['action']) && $_GET['action'] == 'delete_q') {
            $admin->deleteQuest();
        }
        //Перенос в другую категорию
        if (isset($_GET['action']) && $_GET['action'] == 'c_id_change') {
            $admin->changeQuestCategory();
        }
        //Изменения татуса (опудликован или нет)
        if (isset($_GET['action']) && $_GET['action'] == 'q_stat_change') {
            $admin->changeStatus();
        }
        //Правка вопроса и добавление или правка ответа
        if (isset($_GET['action']) && $_GET['action'] == 'change_q_and_a') {
            $admin->changeQuestAndAns();
        }
        //список вопросов разбитых на категории
        $admin->questAndAnswer();
    }
}