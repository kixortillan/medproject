<?php

namespace App\Libraries\Repositories\Core\Contracts;

use App\Libraries\Repositories\Core\Contracts\InterfaceRepository;
use App\Models\Core\Department;

interface InterfaceDepartmentRepository extends InterfaceRepository {

    /**
     * 
     * @param Department $model
     */
    public function save(Department $model);
}
