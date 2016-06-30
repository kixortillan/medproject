<?php

namespace App\Libraries\Repositories\Core;

use Illuminate\Database\Query\Builder;
use Exception;
use DB;

class BaseRepository {

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
     * @param \Illuminate\Database\Query\Builder $builder
     */
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

        return $this->builder
                        ->newQuery()
                        ->from($this->builder->from);
    }

}
