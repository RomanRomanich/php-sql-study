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
        $admin->userDelete($_GET['us_id']);
        header('Location: ./index.php?service=user');
    }
    //Добавление пользователя
    public function userAdd()
    {
        $admin = new \Models\Users($this->db);
        $render = new \Render();

        if (isset($_GET['login']) && $admin->getUser($_GET['login'])) {
            $fail = 'Такой логин уже есть';
            $render->adminAdd($fail);
            die();
        } elseif ((isset($_GET{'pass1'}) || isset($_GET['pass2'])) && $_GET['pass1'] != $_GET['pass2']) {
            $fail = 'Введенные пароли не совпадают, проверьте правильность ввода';
            $render->adminAdd($fail);
            die();
        } elseif (isset($_GET['login']) && isset($_GET{'pass1'})) {
            $admin->addUser($_GET['login'], password_hash($_GET['pass1'], PASSWORD_DEFAULT));
            header('Location: ./index.php?service=user');
        }
        $render->adminAdd();
    }
    //Смена пароля
    public function passChange()
    {
        $admin = new \Models\Users($this->db);
        $render = new \Render();
        if ((isset($_GET{'pass1'}) || isset($_GET['pass2'])) && $_GET['pass1'] != $_GET['pass2']) {
            $fail = 'Введенные пароли не совпадают, проверьте правильность ввода';
            $render->adminPassChange($fail);
        } elseif ((isset($_GET{'pass1'}) || isset($_GET['pass2']))) {
            $admin->changePass($_GET['us_id'], password_hash($_GET['pass1'], PASSWORD_DEFAULT));
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
        $cat->deleteCats($_GET['c_id']);
        header('Location: ./index.php?service=categories');
    }
    //Добавление категории
    public function addCat()
    {
        $cat = new \Models\Categories($this->db);
        $render = new \Render();
        if (isset($_GET['c_name'])) {
            $cat->addCat($_GET['c_name']);
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
        if (isset($_GET['c_name'])) {
            $cat->renameCat($_GET['c_name'], $_GET['c_id']);
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
        $quests->removeQuest($_GET['q_id']);
        header('Location: ./index.php?service='.$_GET['service'].'&c_id='.$_GET['c_id']);
    }
    //Изменение текста вопроса
    public function changeQuest()
    {
        $quests = new \Models\Questions($this->db);
        $render = new \Render();
        if (isset($_GET['q_name']) && isset($_GET['q_id']) ){
            $quests->changeQuest($_GET['q_id'], $_GET['q_name']);
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
        if (isset($_GET['q_id']) && isset($_GET['ansver']) && isset($_GET['ansverer_name'])) {
            $ansver->addAnswer($_GET['q_id'], $_GET['ansver'], $_GET['ansverer_name']);
            if (!empty($_GET['publish'])) {
                $quests->changeStatus($_GET['q_id'], $_GET['publish']);
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
        if (isset($_GET['c_id'])) {
            $render->questAndAnswerQuest($quests->getQuestAndAnswers($_GET['c_id']), $cats->getAllCats());
        }
    }
    //Смена категории вопроса
    public function changeQuestCategory()
    {
        $quests = new \Models\Questions($this->db);
        if (isset($_GET['q_id']) && isset($_GET['c_id_change'])) {
            $quests->changeCategory($_GET['q_id'], $_GET['c_id_change']);
            header('Location: ./index.php?service='.$_GET['service'].'&c_id='.$_GET['c_id']);
        }
    }
    //Смена статуса опубликован или нет
    public function changeStatus()
    {
        $quests = new \Models\Questions($this->db);
        if (isset($_GET['q_id']) && isset($_GET['q_stat_change'])) {
            $quests->changeStatus($_GET['q_id'], $_GET['q_stat_change']);
            header('Location: ./index.php?service='.$_GET['service'].'&c_id='.$_GET['c_id']);
        }
    }
    //ПРавки вопроса и ответа
    public function changeQuestAndAns()
    {
        $quests = new \Models\Questions($this->db);
        $ans = new \Models\Answers($this->db);
        if (isset($_GET['q_id']) && isset($_GET['q_name']) && isset($_GET['q_auth']) && isset($_GET['a_id']) && isset($_GET['ansver'])) {
            if ($ans->getAnswerCount($_GET['q_id']) > 0){
                $ans->changeAnswer($_GET['a_id'], $_GET['ansver']);
            } else {
                $ans->addAnswer($_GET['q_id'], $_GET['ansver'], $_SESSION['admin_name']);
            }
            $quests->changeQuest($_GET['q_id'], $_GET['q_name']);
            $quests->changeQuestAuth($_GET['q_id'], $_GET['q_auth']);
            header('Location: ./index.php?service=' . $_GET['service'] . '&c_id=' . $_GET['c_id']);
        }
    }
}
