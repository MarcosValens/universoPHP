<?php
require_once __DIR__."/ConnectionInterface.php";
Class ConnectionMysql implements ConnectionInterface
{
    private $connection;
    private static $instance;

    private function __construct()
    {
        try {
            //$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_PERSISTENT => true);

            $this->connection = new PDO('mysql:host=localhost;dbname=univers', 'marcos', 'root');
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print_r($e);
            exit();
        }
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new ConnectionMysql();
        }
        return self::$instance;
    }

    public function connection()
    {
        return $this->connection;
    }

    function desconection()
    {
        $this->connection = null;
    }
}