<?php


namespace system\core;


class DB
{
    protected $pdo;
    protected static $instance;

    private function __construct()
    {
        $db = require ROOT . '/config/db.php';
        $this->pdo = new \PDO($db['dsn'], $db['user'], $db['password']);
    }

    public static function instance()
    {
        if (self::$instance === null){
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function exec($sql)
    {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute();
    }


}