<?php
namespace admin;


class Control
{
    public function mainPage()
    {
        $render = new \Render();
        $render->adminMainPage();
    }

    public function showUser()
    {
        $admin = new \Users();
        $render = new \Render();
        $render->adminList($admin->getAllUsers());
    }

    public function userDelete()
    {
        $admin = new \Users;
        $admin->userDelete($_GET['us_id']);
        header('Location: ./index.php?service=user');
    }

    public function userAdd()
    {
        $admin = new \Users();
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

    public function passChange()
    {
        $admin = new \Users();
        $render = new \Render();
        if ((isset($_GET{'pass1'}) || isset($_GET['pass2'])) && $_GET['pass1'] != $_GET['pass2']) {
            $fail = 'Введенные пароли не совпадают, проверьте правильность ввода';
            $render->adminPassChange($fail);
            die();
        } elseif ((isset($_GET{'pass1'}) || isset($_GET['pass2']))) {
            $admin->changePass($_GET['us_id'], password_hash($_GET['pass1'], PASSWORD_DEFAULT));
            header('Location: ./index.php?service=user');
        }
        $render->adminPassChange();
    }
}