<?php

namespace core\modules;

class Model
{
    private $db;

    public function __construct()
    {
        try {
            $conf = require_once 'core/config/db.php';
            $this->db = new \PDO("mysql:host=".$conf["host"].";dbname=".$conf["dbname"], $conf["user"], $conf["password"], array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING));
        }
        catch (\PDOException $e) {
            print "Ошибка!: " . $e->getMessage();
            die();
        }
    }

    public function insert(){

        $table = get_class($this);
        $table_name = explode("\\", $table);
        $table_name = mb_strtolower($table_name[2]);

        $vars = (get_object_vars ($this));
        unset($vars['db']);

        $sql = "INSERT INTO `" . $table_name . "` (";
        $values = " VALUES (";
        $params = [];
        foreach ($vars as $key => $value) {
            $sql.= "`" . $key . "`". ",";
            $values.="?,";
            array_push($params, $value);
        }
        $sql = substr($sql,0,-1);
        $values = substr($values,0,-1);
        $sql = $sql . ")" . $values . ")";
        $sth = $this->db->prepare($sql);
        return $sth->execute($params);
    }

    public function getUser($email) {
        $sql = "SELECT * FROM `user` WHERE `email`=?";
        $sth = $this->db->prepare($sql);
        $sth->execute(array($email));
        return $sth->fetch(\PDO::FETCH_ASSOC);
    }
}