<?php

namespace App\Libraries\Services\Core\Contracts;

interface InterfaceDepartmentService {

    public function paginate(string $keyword, int $pageNo, int $perPage);
}
