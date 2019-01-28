<?php
class db
{
private $connect = [
'host' => 'localhost',
'name' => 'rbagrov',
'user' => 'rbagrov',
'pass' => 'neto1918'];

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
?>