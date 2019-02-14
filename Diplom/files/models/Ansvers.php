<?php namespace models;


class Ansvers
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function addAnsver($q_id, $ansver, $ansverer_name)
    {
        $ans = $this->db->getDb()->prepare('INSERT INTO `ansvers` (`quest_id`, `ansver`, `ansverer_name`) VALUES (:q_id, :ansver, :ansverer_name)');
        $ans->bindValue(':q_id', $q_id, \PDO::PARAM_INT);
        $ans->bindValue(':ansver', $ansver, \PDO::PARAM_STR);
        $ans->bindValue(':ansverer_name', $ansverer_name, \PDO::PARAM_STR);
        $ans->execute();
    }

    public function changeAnsver($a_id, $ansver)
    {
        $ans = $this->db->getDb()->prepare('UPDATE `ansvers` SET `ansver`= :ansver WHERE `quest_id`= :a_id');
        $ans->bindValue(':a_id', $a_id, \PDO::PARAM_INT);
        $ans->bindValue(':ansver', $ansver, \PDO::PARAM_STR);
        $ans->execute();
    }

    public function getAnsverCount($q_id)
    {
        $ans = $this->db->getDb()->prepare('SELECT COUNT(*) FROM `ansvers` WHERE quest_id = :q_id');
        $ans->bindValue(':q_id', $q_id, \PDO::PARAM_INT);
        $ans->execute();
        return $ans->fetch(\PDO::FETCH_COLUMN);
    }
}