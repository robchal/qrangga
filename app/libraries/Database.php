<?php

class Database {
    private $dbHost = DB_HOST;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;
    private $dbName = DB_NAME;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct() {
        $dsn = 'mysql:host=' . $this->dbHost . ';dbname=' .$this->dbName;
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($dsn, $this->dbUser, $this->dbPass, $options);
        } catch (PDOException $err) {
            $this->error = $err->getMessage();
            echo $this->error;
        }
    }

    //query handler
    public function query($query) {
        $this->stmt = $this->dbh->prepare($query);
    }

    //bind query
    public function bind($param, $value, $type = null) {
        switch( is_null($type) ) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    //execute prepare statment
    public function execute() {
        return $this->stmt->execute();
    }

    //fetch set
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //fetch single
    public function singleSet() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    //row count
    public function rowCount() {
        return $this->stmt->rowCount();
    }
}