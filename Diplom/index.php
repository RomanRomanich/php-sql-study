<?php
session_start();
include('autoload.php');

if (empty ($_SESSION['admin']) || (isset($_GET['admin']) && $_GET['admin'] == 0)) {
    $_SESSION['admin'] = 0;
}

//  user section
if($_SESSION['admin'] == 0) {
    $user = new user\Control();
    if (isset($_GET['admin']) && $_GET['admin'] == 1) {
        $user ->signin();
    }
    if (empty($_GET['admin']) || $_GET['admin'] != 1) {
        $user->mainPage();
    }
    if (isset($_POST['add_quest']) && $_POST['add_quest'] == 1) {
        $user->addQuestion();
    }
}

//  admin section
if ($_SESSION['admin'] == 1) {
    $user = new admin\Control();
    if (empty($_GET['service']) || (isset($_GET['service'])) && $_GET['service'] == 'main') {
        $user->mainPage();
    }

    if  (isset($_GET['service']) && $_GET['service'] == 'user') {

        if (isset($_GET['action']) && $_GET['action'] == 'delete') {
            $user->userDelete();
        }
        elseif (isset($_GET['action']) && $_GET['action'] == 'add')
        {
            $user->userAdd();
        }
        elseif (isset($_GET['action']) && $_GET['action'] == 'pass_change')
        {
            $user->passChange();
        }
        else {
            $user->showUser();
        }
    }
    elseif (isset($_GET['service']) && $_GET['service'] == 'categories') {
        /*$cat = new Categories();
        $cats = $cat->getAllCats();*/
        echo 'пока в работе <br>';
        echo '<a href="?service=main">Вернуться</a>';
    }







    #include('./files/controllers/admin/admin_control.php');
}
























/*if (class_exists('Router')) {
    if (!isset($start)) {
        $start = new Router();
        $start->start();
    } else {
        $start->start();
    }
} else {
    echo 'net takokgo klassa';
    die();
}*/

?>