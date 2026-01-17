<?php

namespace App\Core\Database\Schema;

use App\Core\Bootstrap\Bootstrap;

class Schema {
    public static function create($table, $callback) {
        $blueprint = new Blueprint();
        $callback($blueprint);

        $sql = "CREATE TABLE $table (" . $blueprint->getSql() . ")";
        $db = Bootstrap::initDatabase();
        $db->exec($sql);
    }
}