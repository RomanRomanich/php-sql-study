<?php


class Categories
{

    public function getAllCats()
    {
        $db = new db();
        $cat = $db->getDb()->prepare('SELECT * FROM `categories`');
        $cat->execute();
        #print_r($cat->fetchAll());
        return $cat->fetchAll(PDO::FETCH_ASSOC);
    }
}