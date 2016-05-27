<?php

namespace App\Libraries\Repositories\Core;

use Exception;
use DB;

abstract class BaseRepository {

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

    public function __construct() {
        
    }

    /**
     * 
     * @throws Exception
     */
    protected function initBuilder() {
        if (!isset($this->mainTable)) {
            throw new Exception('Main database table not yet initialized.');
        }

        $this->builder = DB::table($this->mainTable);
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
