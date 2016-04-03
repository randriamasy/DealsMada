<?php

require_once dirname(__FILE__) . '/database.class.php';

// =======================================================================================
class City extends DBObject {

    /**
     * See database
     * city(id, name)
     */
    
    // =======================================================================================
    static function selectAll() {
        return DataBase::selectAll('city', __CLASS__);
    }

    // =======================================================================================
    static function insert($name) {
        $values = array(
            'name' => $name
        );
        return DataBase::insert('city', $values);
    }

    // =======================================================================================
    static function deleteById($id) {
        $conditions = array(
            'id' => $id
        );
        return DataBase::delete('city', $conditions);
    }

}

?>