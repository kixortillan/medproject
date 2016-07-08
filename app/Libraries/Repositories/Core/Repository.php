<?php

namespace App\Libraries\Repositories\Core;

use DB;

class Repository {

    /**
     *
     * @var string 
     */
    protected $tableName;

    public function __construct($tableName = null) {
        if (isset($tableName)) {
            $this->tableName = $tableName;
        }
    }

    /**
     * 
     * @param string $tableName
     */
    public function setTable($tableName) {
        $this->tableName = $tableName;
    }

    /**
     * 
     * @return string
     */
    public function getTable() {
        return $this->tableName;
    }

    /**
     * 
     * @return \Illuminate\Database\Query\Builder
     */
    public function builder() {
        return DB::table($this->tableName);
    }

}
