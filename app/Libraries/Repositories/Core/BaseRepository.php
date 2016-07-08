<?php

namespace App\Libraries\Repositories\Core;

use App\Libraries\Repositories\Core\Repository;

class BaseRepository {

    /**
     *
     * @var mixed
     */
    protected $result;

    /**
     *
     * @var \App\Libraries\Repositories\Core\Repository
     */
    protected $repo;

    /**
     * 
     */
    public function __construct(Repository $repo) {
        $this->repo = $repo;
    }

    /**
     * 
     * @param \App\Libraries\Repositories\Core\Repository $repo
     */
    public function setRepository(Repository $repo) {
        $this->repo = $repo;
    }

    /**
     * 
     * @return \App\Libraries\Repositories\Core\Repository
     */
    public function getRepository() {
        return $this->repo;
    }

    /**
     * 
     * @return \Illuminate\Database\Query\Builder
     */
    public function getQueryBuilder() {
        return $this->repo->builder();
    }

}
