<?php namespace user;

//Класс управления для пользователей
class Control
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
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $users = new \models\Users($this->db);
            $user = $users->getUser($_POST['login']);
            if ($user && password_verify($_POST['password'], $user['password'])) { //проверка связки логин+пароль
                $_SESSION['admin'] = 1;  //Для перехода в админку
                $_SESSION['admin_name'] = $_POST['login']; //Сохраняем Имя администратора
                header('Location: ./index.php');
            } else {
                $fail/*['fail']*/ = 'Ошибка логина и (или) пароля';
                $ren = new \Render($this->db);
                $ren->adminCheckPage($fail);
            }
        }
        $ren = new \Render($this->db);
        $ren->adminCheckPage();
    }
    //Формирование главной пользовательской страницы
    public function mainPage()
    {
        $_SESSION['admin'] = 0;
        $cats = new \models\Categories($this->db);
        $ren = new \Render($this->db);
        $ren->userMainPage($cats->getViewableCats(), $cats->getAllCats(), new \models\Questions($this->db));
    }
    //Формирование модуля добавления вопросов
    public function addQuestion()
    {
        $a = new \models\Questions($this->db);
        $a->addQuestion($_POST);
        #header('Location: ./index.php');
        header('Location: /');
    }

}