<?php

namespace App\Libraries\Repositories\Core\Contracts;

use App\Libraries\Common\ValueObjects\SearchCriteria;
use App\Libraries\Entities\Core\Department;

interface InterfaceDepartmentRepository {

    /**
     * 
     * @param Department $model
     */
    public function save(Department $model);

    /**
     * 
     * @param int $id
     */
    public function delete(int $id);

    /**
     * 
     * @param string $code
     */
    public function findByCode(string $code);

    /**
     * 
     * @param SearchCriteria $search
     */
    public function findAll(SearchCriteria $search);

    /**
     * 
     */
    public function count();
}
