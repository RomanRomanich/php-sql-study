<?php namespace Models;

//работа с категориями вопросов
class Categories
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    //Получение категорий в которые опубликованные вопросы для отображения на пользовательской странице
    public function getViewableCats()
    {
        $cat = $this->db->getDb()->prepare('SELECT `cat_name`, `categories`.`id` AS `id` 
FROM `categories` 
INNER JOIN `quests` ON `quests`.`category_id` = `categories`.`id` 
WHERE `quests`.`published`=1
GROUP BY `cat_name`');
        $cat->execute();
        return $cat->fetchAll(\PDO::FETCH_ASSOC);
    }
    //Список всех категорий
    public function getAllCats()
    {
        $cat = $this->db->getDb()->prepare('SELECT * FROM `categories` WHERE 1');
        $cat->execute();
        return $cat->fetchAll(\PDO::FETCH_ASSOC);
    }
    //Удаление категорий
    public function deleteCats($cId)
    {
        $cat = $this->db->getDb()->prepare('DELETE FROM `categories` WHERE `id` = :c_id');
        $cat->bindValue(':c_id', $cId, \PDO::PARAM_INT);
        $cat->execute();
    }
    //Добавление категории
    public function addCat($cName)
    {
        $cat = $this->db->getDb()->prepare('INSERT INTO `categories` (`cat_name`) VALUES (:c_name)');
        $cat->bindValue(':c_name', $cName, \PDO::PARAM_STR);
        $cat->execute();
    }
    //Переименование категории
    public function renameCat($cName, $cId)
    {
        $cat = $this->db->getDb()->prepare('UPDATE `categories` SET `cat_name` = :c_name WHERE `id` = :c_id');
        $cat->bindValue(':c_name', $cName, \PDO::PARAM_STR);
        $cat->bindValue(':c_id', $cId, \PDO::PARAM_INT);
        $cat->execute();
    }
}
