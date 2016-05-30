<?php

namespace App\Libraries\Repositories\Core\Contracts;

use App\Models\Core\Department;

interface InterfaceDepartmentRepository {

    /**
     * 
     */
    public function get();

    /**
     * 
     * @param type $limit
     * @param type $offset
     */
    public function all($limit = null, $offset = null);

    /**
     * 
     * @param Department $model
     */
    public function save(Department $model);
}
