<?php namespace Models;


class Answers
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function addAnswer($qId, $answer, $answererName)
    {
        $ans = $this->db->getDb()->prepare('INSERT INTO `ansvers` (`quest_id`, `ansver`, `ansverer_name`) VALUES (:q_id, :ansver, :ansverer_name)');
        $ans->bindValue(':q_id', $qId, \PDO::PARAM_INT);
        $ans->bindValue(':ansver', $answer, \PDO::PARAM_STR);
        $ans->bindValue(':ansverer_name', $answererName, \PDO::PARAM_STR);
        $ans->execute();
    }

    public function changeAnswer($a_id, $ansver)
    {
        $ans = $this->db->getDb()->prepare('UPDATE `ansvers` SET `ansver`= :ansver WHERE `quest_id`= :a_id');
        $ans->bindValue(':a_id', $a_id, \PDO::PARAM_INT);
        $ans->bindValue(':ansver', $ansver, \PDO::PARAM_STR);
        $ans->execute();
    }

    public function getAnswerCount($qId)
    {
        $ans = $this->db->getDb()->prepare('SELECT COUNT(*) FROM `ansvers` WHERE quest_id = :q_id');
        $ans->bindValue(':q_id', $qId, \PDO::PARAM_INT);
        $ans->execute();
        return $ans->fetch(\PDO::FETCH_COLUMN);
    }
}