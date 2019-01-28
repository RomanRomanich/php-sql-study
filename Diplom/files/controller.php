<?php

if (empty ($_SESSION['admin'])){
    $_SESSION['admin'] = 0;
}

if (isset($_GET['admin']) && $_GET['admin'] == 1) {
    $_SESSION['admin'] = 1;
    header('Location: ./files/admin/for_admin.php');
}

if (empty($_GET['admin']) || $_GET['admin'] != 1) {
    $_SESSION['admin'] = 0;
    $cats = new Categories();
    $allCats = $cats->getAllCats();
    $quests = new Questions();
    #include('./user.php');
}

if (isset($_POST['add_quest']) && $_POST['add_quest'] == 1) {
    $a = new Questions();
    $a->addQuestion($_POST);
    #$_POST['add_quest'] = 0;
    header('Location: ./index.php');
}
include('./user.php');
?>