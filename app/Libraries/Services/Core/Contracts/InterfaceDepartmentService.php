<?php

namespace App\Libraries\Services\Core\Contracts;

interface InterfaceDepartmentService {

    public function paginate($page, $perPage, $keyword = null);

    public function departmentDetails($code);
}
