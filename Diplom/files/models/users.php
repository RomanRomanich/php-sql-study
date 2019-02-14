<?php namespace models;

//работас  пользователями
class Users
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    //выбор информации по конкретному пользователю
    public function getUser($user)
    {
        $users = $this->db->getDb()->prepare('SELECT `login`, `password` FROM `admins` WHERE `login` = :login');
        $users->bindValue(':login', $user, \PDO::PARAM_STR);
        $users->execute();
        return $users->fetch(\PDO::FETCH_ASSOC);
    }
    //Получение информации по сем пользователям
    public function getAllUsers()
    {
        $users = $this->db->getDb()->prepare('SELECT * FROM `admins` WHERE 1');
        $users->execute();
        return $users->fetchAll(\PDO::FETCH_ASSOC);
    }
    //удаление пользщователя
    public function userDelete($id)
    {
        $users = $this->db->getDb()->prepare('DELETE FROM `admins` WHERE `id`= :id');
        $users->bindValue(':id', $id, \PDO::PARAM_INT);
        $users->execute();
    }
    //добавить пользователя
    public function addUser($login, $pass)
    {
        $users = $this->db->getDb()->prepare('INSERT INTO `admins`(`login`, `password`) VALUES (:login, :pass)');
        $users->bindValue(':login', $login, \PDO::PARAM_STR);
        $users->bindValue(':pass', $pass, \PDO::PARAM_STR);
        $users->execute();
    }
    //Изменить пароль
    public function changePass($id, $pass)
    {
        $users = $this->db->getDb()->prepare('UPDATE `admins` SET `password`= :pass WHERE `id`= :id');
        $users->bindValue(':id', $id, \PDO::PARAM_INT);
        $users->bindValue(':pass', $pass, \PDO::PARAM_STR);
        $users->execute();
    }
}