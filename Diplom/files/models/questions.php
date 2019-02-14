<?php namespace models;

//работа с вопросами
class Questions
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function addQuestion($add_quest)
    {
        $add = $this->db->getDb()->prepare('INSERT INTO `quests`(`quest`, `category_id`, `quester_name`, `quester_mail`) VALUES (:quest, :category_id, :quester_name, :quester_mail)');
        $add->bindValue(':quest', $add_quest['quest'], \PDO::PARAM_STR);
        $add->bindValue(':category_id', $add_quest['category_id'], \PDO::PARAM_INT);
        $add->bindValue(':quester_name', $add_quest['quester_name'], \PDO::PARAM_STR);
        $add->bindValue(':quester_mail', $add_quest['quester_mail'], \PDO::PARAM_STR);
        $add->execute();
    }
    //выбор вопросов и ответов к ним. В качестве параметров передаются id катеории и статус. по умолчанию стоит отображать вопрос в любом статусе
    public function getQuestAndAnswers($categories, $published = 3)
    {
        $getArray = $this->db->getDb()->prepare(
            'SELECT c.id AS category_id, date, quest, quester_name AS q_name, q.id AS quest_id, published, c.cat_name AS c_name,  a.ansver AS ansver, a.ansverer_name AS ansverer, a.id AS a_id, a.quest_id AS a_quest_id
            FROM quests q
            INNER JOIN categories c ON c.id=q.category_id
            LEFT JOIN ansvers a ON a.quest_id=q.id
            WHERE c.id= :c_id AND q.published <> :published');
        $getArray->bindValue(':c_id', $categories, \PDO::PARAM_INT);
        $getArray->bindValue(':published', $published, \PDO::PARAM_INT);
        $getArray->execute();
        return  $getArray->fetchAll(\PDO::FETCH_ASSOC);
    }

/*
 *  Функция работает через инверсию. По умолчанию отображаются все вопросы, для выбора только опубликованных параметр
    $publish указывается "0", для выбора неопубликованных - "1"
*/
    public function questsCount($cats, $unpublish = 2)
    {
        $getArray = $this->db->getDb()->prepare('SELECT c.id AS category_id, COUNT(quest) AS counts , q.id AS quest_id
                                                    FROM quests q
                                                    INNER JOIN categories c ON c.id=q.category_id
                                                    WHERE c.id= :c_id AND q.published != :publish');
        $getArray->bindValue(':c_id', $cats, \PDO::PARAM_INT);
        $getArray->bindValue(':publish', $unpublish, \PDO::PARAM_INT);
        $getArray->execute();
        return $getArray->fetch(\PDO::FETCH_ASSOC);
    }
    // Выбор всех вопросо без ответов
    public function getQ_no_ans()
    {
        $getArray = $this->db->getDb()->prepare('SELECT `quests`.`id`,`quest`,`quester_name`,`quester_mail`,`date`,`published` FROM `quests`
LEFT JOIN `ansvers` ON `quests`.`id` = `ansvers`.`quest_id`
WHERE `ansvers`.`quest_id` IS null
ORDER BY `quests`.`date` DESC');
        $getArray->execute();
        return $getArray->fetchAll(\PDO::FETCH_ASSOC);
    }
    //удаление вопроса
    public function removeQuest($q_id)
    {
        $quest = $this->db->getDb()->prepare('DELETE FROM `quests` WHERE `quests`.`id` = :q_id');
        $quest->bindValue(':q_id', $q_id, \PDO::PARAM_INT);
        $quest->execute();
    }
    //Смена текста вопроса
    public function changeQuest($q_id, $q_name)
    {
        $quest = $this->db->getDb()->prepare('UPDATE `quests` SET `quest` = :q_name WHERE `id` = :q_id');
        $quest->bindValue(':q_name', $q_name, \PDO::PARAM_STR);
        $quest->bindValue(':q_id', $q_id, \PDO::PARAM_STR);
        $quest->execute();
    }
    //Перенос вопроса в другую категорию
    public function changeCategory($q_id, $c_name)
    {
        $quest = $this->db->getDb()->prepare('UPDATE `quests` SET `category_id` = :c_name WHERE `id` = :q_id');
        $quest->bindValue(':c_name', $c_name, \PDO::PARAM_STR);
        $quest->bindValue(':q_id', $q_id, \PDO::PARAM_STR);
        $quest->execute();
    }
    //Смена состояния вопроса (обпуликован или нет)
    public function changeStatus($q_id, $stat = 0)
    {
        $quest = $this->db->getDb()->prepare('UPDATE `quests` SET `published` = :stat WHERE `id` = :q_id');
        $quest->bindValue(':stat', $stat, \PDO::PARAM_STR);
        $quest->bindValue(':q_id', $q_id, \PDO::PARAM_STR);
        $quest->execute();
    }
    //Изменение имени автора вопроса
    public function changeQuestAuth($q_id, $auth)
    {
        $quest = $this->db->getDb()->prepare('UPDATE `quests` SET `quester_name` = :auth WHERE `id` = :q_id');
        $quest->bindValue(':auth', $auth, \PDO::PARAM_STR);
        $quest->bindValue(':q_id', $q_id, \PDO::PARAM_STR);
        $quest->execute();
    }
}