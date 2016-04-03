<?php

require_once dirname(__FILE__) . '/database.class.php';

// =======================================================================================
class Report extends DBObject {

    /**
     * See database
     * report(id, sentAt, event, description, device, os, build)
     */
    // =======================================================================================
    // =======================================================================================
    static function selectAllByEvent($event) {
        $sql = "SELECT * FROM  report WHERE event='$event' ORDER BY  report.sentAt DESC";
        return DataBase::execute($sql, __CLASS__);
    }

    // =======================================================================================
    static function deleteAllByEvent($event) {
        $conditions = array(
            'event' => $event
        );
        return DataBase::delete('report', $conditions);
    }

    // =======================================================================================
    static function insert($event, $description, $device, $os, $build) {
        $values = array(
            'event' => $event,
            'description' => $description,
            'device' => $device,
            'os' => $os,
            'build' => $build
        );
        return DataBase::insert('report', $values);
    }

}

?>