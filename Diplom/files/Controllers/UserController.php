<?php namespace Controllers;

//Класс управления для пользователей
class UserController
{
    //подключение к БД
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    //Функция проверки правильности ввода логина и пароля для входа в админку
    public function signin()
    {
        $ren = new \Render();
        $users = new \Models\Users($this->db);
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $user = $users->getUser($_POST['login']);
            if ($user && password_verify($_POST['password'], $user['password'])) { //проверка связки логин+пароль
                $_SESSION['admin'] = 1;  //Для перехода в админку
                $_SESSION['admin_name'] = $_POST['login']; //Сохраняем Имя администратора
                header('Location: ./index.php');
            } else {
                $fail = 'Ошибка логина и (или) пароля';
                $ren->adminCheckPage($fail);
            }
        }

        $ren->adminCheckPage();
    }
    //Формирование главной пользовательской страницы
    public function mainPage()
    {
        $_SESSION['admin'] = 0;
        $cat = new \Models\Categories($this->db);
        $quest = new \Models\Questions($this->db);
        $ren = new \Render();
        $catName = $cat->getViewableCats();
        foreach ($catName as $key => $catsName) {
            $qAndAnsArray[$key]['cat_name'] = $catsName['cat_name'];
            $qAndAnsArray[$key]['id'] = $catsName['id'];
            foreach ($quest->getQuestAndAnswers($catsName['id'],0) as $key2 => $qAndAns) {
                $qAndAnsArray[$key][$catsName['id']][$key2]['quest'] = $qAndAns['quest'];
                $qAndAnsArray[$key][$catsName['id']][$key2]['answer'] = $qAndAns['ansver'];
            }
        }
        $ren->userMainPage($cat->getViewableCats(), $cat->getAllCats(), $qAndAnsArray);
    }
    //Формирование модуля добавления вопросов
    public function addQuestion($quest)
    {
        $a = new \Models\Questions($this->db);
        $a->addQuestion($quest);
        header('Location: ./index.php');
    }
<<<<<<< HEAD:Diplom/files/controllers/UserController.php
}
=======

}
