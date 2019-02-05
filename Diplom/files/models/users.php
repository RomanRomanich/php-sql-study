<?php


class Users
{
    public function getUser($user)
    {
        $db = new db();
        $users = $db->getDb()->prepare('SELECT `login`, `password` FROM `admins` WHERE `login` = :login');
        $users->bindValue(':login', $user, PDO::PARAM_STR);
        $users->execute();
        return $users->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers()
    {
        $db = new db();
        $users = $db->getDb()->prepare('SELECT * FROM `admins` WHERE 1');
        $users->execute();
        return $users->fetchAll(PDO::FETCH_ASSOC);
    }

    public function userDelete($id)
    {
        $db = new db();
        $users = $db->getDb()->prepare('DELETE FROM `admins` WHERE `id`= :id');
        $users->bindValue(':id', $id, PDO::PARAM_INT);
        $users->execute();
    }

    public function addUser($login, $pass)
    {
        $db = new db();
        $users = $db->getDb()->prepare('INSERT INTO `admins`(`login`, `password`) VALUES (:login, :pass)');
        $users->bindValue(':login', $login, PDO::PARAM_STR);
        $users->bindValue(':pass', $pass, PDO::PARAM_STR);
        $users->execute();
    }

    public function changePass($id, $pass)
    {
        $db = new db();
        $users = $db->getDb()->prepare('UPDATE `admins` SET `password`= :pass WHERE `id`= :id');
        $users->bindValue(':id', $id, PDO::PARAM_INT);
        $users->bindValue(':pass', $pass, PDO::PARAM_STR);
        $users->execute();
    }
}