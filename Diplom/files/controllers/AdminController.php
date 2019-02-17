<?php namespace Controllers;

//класс управления для администраторов

class AdminController
{
    //подключениек БД
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    //отображение страницы с главным меню администратора
    public function mainPage()
    {
        $render = new \Render();
        $render->adminMainPage();
    }
    //Формирование страницы со списком пользователей
    public function showUser()
    {
        $admin = new \Models\Users($this->db);
        $render = new \Render();
        $render->adminList($admin->getAllUsers());
    }
    //Удаление пользователя
    public function userDelete()
    {
        $admin = new \Models\Users($this->db);
        if (isset($_POST['us_id'])) {
            $admin->userDelete($_POST['us_id']);
            header('Location: ./index.php?service=user');
        } elseif (isset($_GET['us_id'])) {
            $admin->userDelete($_GET['us_id']);
            header('Location: ./index.php?service=user');
        }
    }
    //Добавление пользователя
    public function userAdd()
    {
        $admin = new \Models\Users($this->db);
        $render = new \Render();

        if (isset($_POST['login']) && $admin->getUser($_POST['login'])) {
            $fail = 'Такой логин уже есть';
            $render->adminAdd($fail);
            die();
        } elseif ((isset($_POST{'pass1'}) || isset($_POST['pass2'])) && $_POST['pass1'] != $_POST['pass2']) {
            $fail = 'Введенные пароли не совпадают, проверьте правильность ввода';
            $render->adminAdd($fail);
            die();
        } elseif (isset($_POST['login']) && isset($_POST{'pass1'})) {
            $admin->addUser($_POST['login'], password_hash($_POST['pass1'], PASSWORD_DEFAULT));
            header('Location: ./index.php?service=user');
        }
        $render->adminAdd();
    }
    //Смена пароля
    public function passChange()
    {
        $admin = new \Models\Users($this->db);
        $render = new \Render();
        if ((isset($_POST{'pass1'}) || isset($_POST['pass2'])) && $_POST['pass1'] != $_POST['pass2']) {
            $fail = 'Введенные пароли не совпадают, проверьте правильность ввода';
            $render->adminPassChange($fail);
        } elseif ((isset($_POST{'pass1'}) || isset($_POST['pass2']))) {
            $admin->changePass($_POST['us_id'], password_hash($_POST['pass1'], PASSWORD_DEFAULT));
            header('Location: ./index.php?service=user');
        } else {
            $render->adminPassChange();
        }
    }
    //ПОказать все категории
    public function showAllCats()
    {
        $cat = new \Models\Categories($this->db);
        $quest = new \Models\Questions($this->db);
        $render = new \Render();
        foreach ($cat->getAllCats() as $key => $catsName) {
            $allCats[$key]['id'] = $catsName['id'];
            $allCats[$key]['cat_name'] = $catsName['cat_name'];
            $allCats[$key]['total'] = $quest->questsCount($catsName['id'])['counts'];
            $allCats[$key]['pub'] = $quest->questsCount($catsName['id'], 0)['counts'];
            $allCats[$key]['unpub'] = $quest->questsCount($catsName['id'], 1)['counts'];
        }
        $render->catList($allCats);
    }
    //Удаление категории
    public function deleteCats()
    {
        $cat = new \Models\Categories($this->db);
        if (isset($_POST['c_id'])) {
            $cat->deleteCats($_POST['c_id']);
            header('Location: ./index.php?service=categories');
        } elseif (isset($_GET['c_id'])) {
            $cat->deleteCats($_GET['c_id']);
            header('Location: ./index.php?service=categories');
        }
    }
    //Добавление категории
    public function addCat()
    {
        $cat = new \Models\Categories($this->db);
        $render = new \Render();
        if (isset($_POST['c_name'])) {
            $cat->addCat($_POST['c_name']);
            header('Location: ./index.php?service=categories');
        } else {
            $render->addCat();
        }
    }
    //Переименование категории
    public function renameCat()
    {
        $cat = new \Models\Categories($this->db);
        $render = new \Render();
        if (isset($_POST['c_name'])) {
            $cat->renameCat($_POST['c_name'], $_POST['c_id']);
            header('Location: ./index.php?service=categories');
        } else {
            $render->renameCat();
        }
    }
    // отображение вопросов без ответов
    public function q_no_ans()
    {
        $quests = new \Models\Questions($this->db);
        $render = new \Render();
        $render->q_no_answer($quests->getQ_no_ans());
    }
    //удаление вопроса
    public function deleteQuest()
    {
        $quests = new \Models\Questions($this->db);
        if (isset($_POST['q_id'])) {
            $quests->removeQuest($_POST['q_id']);
            header('Location: ./index.php?service='.$_POST['service'].'&c_id='.$_POST['c_id']);
        } elseif (isset($_GET['q_id'])) {
            $quests->removeQuest($_GET['q_id']);
            header('Location: ./index.php?service='.$_GET['service'].'&c_id='.$_GET['c_id']);
        }

    }
    //Изменение текста вопроса
    public function changeQuest()
    {
        $quests = new \Models\Questions($this->db);
        $render = new \Render();
        if (isset($_POST['q_name']) && isset($_POST['q_id']) ){
            $quests->changeQuest($_POST['q_id'], $_POST['q_name']);
            header('Location: ./index.php?service=q_no_ans');
        } else {
            $render->changeQuest();
        }
    }
    //Добавление ответа
    public function addAnswer()
    {
        $quests = new \Models\Questions($this->db);
        $render = new \Render();
        $ansver = new \Models\Answers($this->db);
        if (isset($_POST['q_id']) && isset($_POST['ansver']) && isset($_POST['ansverer_name'])) {
            $ansver->addAnswer($_POST['q_id'], $_POST['ansver'], $_POST['ansverer_name']);
            if (!empty($_POST['publish'])) {
                $quests->changeStatus($_POST['q_id'], $_POST['publish']);
            }
            header('Location: ./index.php?service=q_no_ans');
        } else {
            $render->addAnswer();
        }
    }
    //Отображеие всех вопросов и ответо к ним если такие есть
    public function questAndAnswer()
    {
        $quests = new \Models\Questions($this->db);
        $cats = new \Models\Categories($this->db);
        $render = new \Render();
        $render->questAndAnswerCats($cats->getAllCats());
        if (isset($_POST['c_id'])) {
            $render->questAndAnswerQuest($quests->getQuestAndAnswers($_POST['c_id']), $cats->getAllCats());
        } elseif (isset($_GET['c_id'])) {
            $render->questAndAnswerQuest($quests->getQuestAndAnswers($_GET['c_id']), $cats->getAllCats());
        }
    }
    //Смена категории вопроса
    public function changeQuestCategory()
    {
        $quests = new \Models\Questions($this->db);
        if (isset($_POST['q_id']) && isset($_POST['c_id_change'])) {
            $quests->changeCategory($_POST['q_id'], $_POST['c_id_change']);
            header('Location: ./index.php?service='.$_POST['service'].'&c_id='.$_POST['c_id']);
        }
    }
    //Смена статуса опубликован или нет
    public function changeStatus()
    {
        $quests = new \Models\Questions($this->db);
        if (isset($_POST['q_id']) && isset($_POST['q_stat_change'])) {
            $quests->changeStatus($_POST['q_id'], $_POST['q_stat_change']);
            header('Location: ./index.php?service='.$_POST['service'].'&c_id='.$_POST['c_id']);
        }
    }
    //ПРавки вопроса и ответа
    public function changeQuestAndAns()
    {
        $quests = new \Models\Questions($this->db);
        $ans = new \Models\Answers($this->db);
        if (isset($_POST['q_id']) && isset($_POST['q_name']) && isset($_POST['q_auth']) && isset($_POST['a_id']) && isset($_POST['ansver'])) {
            if ($ans->getAnswerCount($_POST['q_id']) > 0){
                $ans->changeAnswer($_POST['a_id'], $_POST['ansver']);
            } else {
                $ans->addAnswer($_POST['q_id'], $_POST['ansver'], $_SESSION['admin_name']);
            }
            $quests->changeQuest($_POST['q_id'], $_POST['q_name']);
            $quests->changeQuestAuth($_POST['q_id'], $_POST['q_auth']);
            header('Location: ./index.php?service=' . $_POST['service'] . '&c_id=' . $_POST['c_id']);
        }
    }
}