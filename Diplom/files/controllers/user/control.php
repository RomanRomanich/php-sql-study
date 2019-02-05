<?php namespace user;


class Control
{
    public function signin()
    {
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $users = new \Users();
            $user = $users->getUser($_POST['login']);
            if ($user && password_verify($_POST['password'], $user['password'])) {
                $_SESSION['admin'] = 1;
                header('Location: ./index.php');
            } else {
                $fail/*['fail']*/ = 'Ошибка логина и (или) пароля';
                $ren = new \Render();
                $ren->adminCheckPage($fail);
            }
        }
        $ren = new \Render();
        $ren->adminCheckPage();
    }

    public function mainPage()
    {
        $_SESSION['admin'] = 0;
        $cats = new \Categories();
        $ren = new \Render();
        $ren->userMainPage($cats->getViewableCats(), $cats->getAllCats(), new \Questions());
    }

    public function addQuestion()
    {
        $a = new \Questions();
        $a->addQuestion($_POST);
        #header('Location: ./index.php');
        header('Location: /');
    }

}