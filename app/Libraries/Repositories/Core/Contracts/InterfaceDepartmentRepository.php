<?php

namespace App\Libraries\Repositories\Core\Contracts;

use App\Models\Core\Department;

interface InterfaceDepartmentRepository {

    /**
     * 
     * @param int $id
     */
    public function get($id);

    /**
     * 
     */
    public function all();

    /**
     * 
     * @param Department $model
     */
    public function save(Department $model);
}
