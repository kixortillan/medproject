<?php

namespace App\Libraries\Services\Core\Contracts;

interface InterfaceDepartmentService {

    public function paginate(int $pageNo, int $perPage, string $keyword);

    public function departmentDetails(string $code);
}
