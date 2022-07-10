<?php

namespace Base;

class Db
{
    private static $instance;
    private $pdo;
    private function __construct()
    {
    }
    private function __clone()
    {
    }
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    private function connect()
    {
        $host = HOST;
        $db_name = DB_NAME;
        $user = USER;
        $password = PASSWORD;


        if (!$this->pdo) {
            $dsn = "mysql:dbname=$db_name;host=$host";
            $user =  $user;
            $password = $password;

            $this->pdo = new \PDO($dsn, $user, $password);
        }
        return $this->pdo;
    }
    public function exec(string $query, array $params = [], string $method = '')
    {
        $this->connect();
        $query = $this->pdo->prepare($query);
        $ret = $query->execute($params);

        if (!$ret) {
            if ($query->errorCode()) {
                trigger_error($query->errorInfo());
            }
            return false;
        }
        return $query->rowCount();
    }

    public function findOne(string $query, array $params = [], string $method = '')
    {
        $this->connect();
        $query = $this->pdo->prepare($query);
        $ret = $query->execute($params);
        if (!$ret) {
            if ($query->errorCode()) {
                trigger_error($query->errorInfo());
            }
            return [];
        }

        $data = $query->fetchAll(\PDO::FETCH_ASSOC);
        $affectedRows = $query->rowCount();
        return reset($data);
    }

    public function findAll(string $query, array $params = [], string $method = '')
    {
        $this->connect();
        $query = $this->pdo->prepare($query);
        $ret = $query->execute($params);
        if (!$ret) {
            if ($query->errorCode()) {
                trigger_error($query->errorInfo());
            }
            return [];
        }
        $data = $query->fetchAll(\PDO::FETCH_ASSOC);
        $affectedRows = $query->rowCount();
        return $data;
    }
   
    public function lastinsertId()
    {
        $this->connect();
        return $this->pdo->lastinsertId();
    }
}
