<?php


class Render
{
    public function userMainPage($cats, $allCats, $quests)
    {
        include_once ('./files/templates/user/user.php');
    }

    public function adminCheckPage($fail = '')
    {
        include_once('./files/templates/user/admin_sign_check.php');
    }

    public function adminMainPage()
    {
        include_once ('./files/templates/admin/admin_main.php');
    }

    public function adminList($admins)
    {
        include_once ('./files/templates/admin/admin_list.php');
    }

    public function adminAdd($fail = '')
    {
        include_once ('./files/templates/admin/admin_add.php');
    }

    public function adminPassChange($fail = '')
    {
        include_once ('./files/templates/admin/pass_change.php');
    }

    public function catList($cats)
    {
        include_once ('./files/templates/admin/cats_list.php');
    }

    public function addCat()
    {
        include_once ('./files/templates/admin/cat_add.php');
    }

    public function renameCat()
    {
        include_once ('./files/templates/admin/cat_rename.php');
    }

    public function q_no_answer($quests)
    {
        include_once ('./files/templates/admin/q_no_ans.php');
    }

    public function changeQuest()
    {
        include_once ('./files/templates/admin/quest_change.php');
    }

    public function addAnswer()
    {
        include_once ('./files/templates/admin/ansver_add.php');
    }

    public function questAndAnswerCats($cats)
    {
        include_once ('./files/templates/admin/q_and_a_cats.php');
    }

    public function questAndAnswerQuest($questAndAnsvers, $cats)
    {
        include_once ('./files/templates/admin/q_and_a_quest.php');
    }
}