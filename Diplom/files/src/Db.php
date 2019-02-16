<?php

class Db
{
    private $connect = [
        'host' => 'localhost',
        'name' => 'db_faq',
        'user' => 'root',
        'pass' => 'Destroer'];

    public function getDb()
    {
        try {
            $db = new PDO('mysql:host=' . $this->connect['host'] . ';dbname=' . $this->connect['name'] . ';charset=UTF8', $this->connect['user'], $this->connect['pass']);
        } catch (PDOException $e) {
            die('Database error: '.$e->getMessage().'<br/>');
        }
        return $db;
    }
}