<?php


class Questions
{
    public function addQuestion($add_quest)
    {
        #print_r($add_quest);
        $db = new db();
        $add = $db->getDb()->prepare('INSERT INTO `quests`(`quest`, `category_id`, `quester_name`, `quester_mail`) VALUES (:quest, :category_id, :quester_name, :quester_mail)');
        $add->bindValue(':quest', $add_quest['quest'], PDO::PARAM_STR);
        $add->bindValue(':category_id', $add_quest['category_id'], PDO::PARAM_INT);
        $add->bindValue(':quester_name', $add_quest['quester_name'], PDO::PARAM_STR);
        $add->bindValue(':quester_mail', $add_quest['quester_mail'], PDO::PARAM_STR);
        $add->execute();
    }

    public function getQuestAndAnswers($categories)
    {
        $db = new db();
        $getArray = $db->getDb()->prepare(
            'SELECT c.id AS category_id, quest, q.id AS quest_id, a.ansver AS ansver
                      FROM quests q
                      INNER JOIN categories c ON c.id=q.category_id
                      INNER JOIN ansvers a ON a.quest_id=q.id
                      WHERE c.id= :c_id');
        $getArray->bindValue(':c_id', $categories, PDO::PARAM_INT);
        $getArray->execute();
        return  $getArray->fetchAll(PDO::FETCH_ASSOC);
    }
}