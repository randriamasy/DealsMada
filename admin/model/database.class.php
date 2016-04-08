<?php

require_once dirname(__FILE__) . '/config.php';

// =======================================================================================
class DataBase extends PDO {

    // =======================================================================================
    private static $instance = NULL;

    // =======================================================================================
    private static function getInstance() {
        if (!self::$instance) {
            self::$instance = new DataBase ();
        }
        return self::$instance;
    }

    // =======================================================================================
    function __construct() {
        parent::__construct("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
        $this->exec("SET NAMES cp1256");
        if (DEBUG) {
            $this->exec("set characer set cp1256");
        } else {
            $this->exec("SET CHARACTER SET utf8");
        }
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Sets error mode
    }

    // =======================================================================================
    static function selectAll($tableName, $className) {
        $sql = "SELECT * FROM  $tableName";
        $results = self::getInstance()->query($sql);
        $objects = $results->fetchALL(PDO::FETCH_CLASS, $className);
        return $objects;
    }
    
    // =======================================================================================
    static function execute($sql, $className) {
        $results = self::getInstance()->query($sql);
        $objects = $results->fetchALL(PDO::FETCH_CLASS, $className);
        return $objects;
    }


    // =======================================================================================
    static function select($tableName, $className, $conditions) {
        $sql = "SELECT * FROM $tableName WHERE ";
        $fieldnames = array_keys($conditions);
        $i = 0;
        foreach ($fieldnames as $fieldname) {
            $i = $i + 1;
            if ($i > 1) {
                $sql = $sql . ' AND ';
            }
            $sql = $sql . $fieldname . " = :" . $fieldname;
        }
        $stmt = self::getInstance()->prepare($sql);
        $stmt->execute($conditions);
        $objects = $stmt->fetchAll(PDO::FETCH_CLASS, $className);
        return $objects;
    }

    // =======================================================================================
    static function selectFirst($tableName, $className, $conditions) {
        $objects = self::select($tableName, $className, $conditions);
        if (sizeof($objects) >= 1) {
            return $objects [0];
        } else {
            return null;
        }
    }

    // =======================================================================================
    static function selectRows($sql) {
        $results = self::getInstance()->query($sql);
        $rows = $results->fetchALL(PDO::FETCH_COLUMN);
        return $rows;
    }

    // =======================================================================================
    static function count($tableName, $field, $conditions) {
        $sql = "SELECT count($field) FROM $tableName WHERE ";
        $fieldnames = array_keys($conditions);
        $i = 0;
        foreach ($fieldnames as $fieldname) {
            $i = $i + 1;
            if ($i > 1) {
                $sql = $sql . ' AND ';
            }
            $sql = $sql . $fieldname . " = :" . $fieldname;
        }
        $stmt = self::getInstance()->prepare($sql);
        $stmt->execute($conditions);
        $rows = $stmt->fetchAll(PDO::FETCH_COLUMN);
        if (sizeof($rows) >= 1) {
            return $rows [0];
        } else {
            return 0;
        }
    }

    // =======================================================================================
    static function delete($tableName, $conditions) {
        $sql = "DELETE FROM  $tableName WHERE ";
        $fieldnames = array_keys($conditions);
        $i = 0;
        foreach ($fieldnames as $fieldname) {
            $i = $i + 1;
            if ($i > 1) {
                $sql = $sql . ' AND ';
            }
            $sql = $sql . $fieldname . " = :" . $fieldname;
        }
        $stmt = self::getInstance()->prepare($sql);
        $res = $stmt->execute($conditions);
        return $res;
    }

    // =======================================================================================
    static function insert($tableName, $values) {
        $fieldnames = array_keys($values);
        $size = sizeof($fieldnames);
        $sql = "INSERT INTO $tableName";
        $fields = '( ' . implode(' ,', $fieldnames) . ' )';
        $bound = '(:' . implode(', :', $fieldnames) . ' )';
        $sql .= $fields . ' VALUES ' . $bound;
        $stmt = self::getInstance()->prepare($sql);
        $res = $stmt->execute($values);
        return $res;
    }

    // =======================================================================================
    static function update($tableName, $values, $conditions) {
        $fieldnames = array_keys($values);
        foreach ($fieldnames as $fieldname) {
            $set [] = $fieldname . " = :" . $fieldname;
        }
        $sql = "UPDATE $tableName SET " . implode(' , ', $set) . " WHERE ";
        $fieldnames = array_keys($conditions);
        $i = 0;
        foreach ($fieldnames as $fieldname) {
            $i = $i + 1;
            if ($i > 1) {
                $sql = $sql . ' AND ';
            }
            $sql = $sql . $fieldname . " = :" . $fieldname;
            $values [$fieldname] = $conditions [$fieldname];
        }
        $stmt = self::getInstance()->prepare($sql);
        $res = $stmt->execute($values);
        return $res;
    }

}

// =======================================================================================
class DBObject {

    // =======================================================================================
    // PDO: Fetch class option to send fields to constructor as array
    // http://stackoverflow.com/questions/9470317/pdo-fetch-class-option-to-send-fields-to-constructor-as-array
    protected $record = array();
	protected $tableName;
    protected function __construct($record = null) {
        $this->record = $record;
		
        if(isset($this->id))$this->id = intval($this->id);
    }

}

?>