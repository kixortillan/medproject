<?php

namespace App\Libraries\Repositories\Core;

use Illuminate\Database\Query\Builder;
use Exception;
use DB;

class BaseRepository {

    /**
     *
     * @var string
     */
    protected $mainTable;

    /**
     *
     * @var mixed
     */
    protected $result;

    /**
     *
     * @var \Illuminate\Database\Query\Builder
     */
    protected $builder;

    /**
     * 
     */
    public function __construct() {
        
    }

    /**
     * 
     * @throws Exception
     */
    /* protected function initBuilder($mainTable = null) {
      if (isset($mainTable)) {
      $this->mainTable = $mainTable;
      }

      if (!isset($this->mainTable)) {
      throw new Exception('Main database table not yet initialized.');
      }

      $this->builder = DB::table($this->mainTable);
      } */

    /**
     * 
     * @param string $tableName
     */
    public function setTable($tableName) {
        $this->mainTable = $tableName;
    }

    public function setBuilder(Builder $builder) {
        $this->builder = $builder;
    }

    /**
     * 
     * @return \Illuminate\Database\Query\Builder
     * @throws Exception
     */
    public function getBuilder() {
        if (!isset($this->builder)) {
            throw new Exception('Query Builder not yet initialized');
        }

        return $this->builder;
    }

}
