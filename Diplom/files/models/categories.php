<?php #namespace files\models;


class Categories
{

    public function getViewableCats()
    {
        $db = new db();
        $cat = $db->getDb()->prepare('SELECT `cat_name`, `categories`.`id` AS `id` 
FROM `categories` 
INNER JOIN `quests` ON `quests`.`category_id` = `categories`.`id` 
INNER JOIN `ansvers` ON `quests`.`id` = `ansvers`.`quest_id`
GROUP BY `cat_name`');
        $cat->execute();
        #print_r($cat->fetchAll());
        return $cat->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllCats()
    {
        $db = new db();
        $cat = $db->getDb()->prepare('SELECT * FROM `categories` WHERE 1');
        $cat->execute();
        #print_r($cat->fetchAll());
        return $cat->fetchAll(PDO::FETCH_ASSOC);
    }
}