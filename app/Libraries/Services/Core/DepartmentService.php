<?php

namespace App\Libraries\Services\Core;

use App\Libraries\Repositories\Core\Contracts\InterfaceRepository;

class DepartmentService {

    protected $deptRepo;

    public function __construct(InterfaceRepository $deptRepo) {
        $this->deptRepo = $deptRepo;
    }

    public function paginate($page, $perPage) {
        $models = $this->departmentRepo->all($page, $perPage * ($page - 1));

        $departments = [];
        foreach ($models as $model) {
            $departments[] = $model->toArray();
        }

        return $departments;
    }

    public function totalCount() {
        return ceil($this->departmentRepo->count());
    }

    public function getOne() {
        
    }

    public function prepareResponse() {
        
    }

}
