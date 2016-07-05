<?php

namespace App\Libraries\Repositories\Core;

use DB;

class Repository {

    protected $tableName;
    protected $queryBuilder;

    public function __construct($tableName = null) {
        if (isset($tableName)) {
            $this->tableName = $tableName;
        }
    }

    public function setTable($tableName) {
        $this->tableName = $tableName;
    }

    public function getTable() {
        return $this->tableName;
    }

    public function builder() {
        return DB::table($this->tableName);
    }

}
