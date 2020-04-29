<?php

class PDB
{
    private static $_instance = null;
    private $_stmt;

    public function __construct($config){
        try {
            $this->dbhost = new PDO(
                'mysql:host=' . $config['HOST'] . ';dbname=' . $config['DATABASE'],
                $config['USER'],
                $config['PASSWORD']
            );
        } catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }

    public static function getInstance($config=[]) {
        if(!isset(self::$_instance)) {
            self::$_instance = new PDB($config);
        }
        return self::$_instance;
    }

    public function query($query) {
        $this->_stmt = $this->dbhost->prepare($query);
    }

    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
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
        }
        $this->_stmt->bindValue($param, $value, $type);
    }

    public function execute() {
        return $this->_stmt->execute();
    }

    public function collections() {
        $this->execute();

        return $this->_stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function count() {
        return $this->_stmt->rowCount();
    }

    public function single() {
        $this->execute();
        return $this->_stmt->fetch(PDO::FETCH_ASSOC);
    }
}