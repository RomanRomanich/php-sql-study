<?php


class Render
{
    public function userMainPage($cats, $allCats, $quests)
    {
        include_once ('./files/templates/user/user.php');
    }

    public function adminCheckPage($fail = '')
    {
        /*ob_start();
        if (count($fails) > 0) {
            extract($fails);
        }*/
        include_once('./files/templates/user/admin_sign_check.php');
        #echo ob_get_clean();
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
}