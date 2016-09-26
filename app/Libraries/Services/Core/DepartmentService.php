<?php

namespace App\Libraries\Services\Core;

use App\Libraries\Repositories\Core\Contracts\InterfaceDepartmentRepository;
use Illuminate\Pagination\Paginator;

class DepartmentService {

    protected $deptRepo;

    public function __construct(InterfaceDepartmentRepository $deptRepo) {
        $this->deptRepo = $deptRepo;
    }

    /**
     * 
     * @param int $page
     * @param int $perPage
     * @return Paginator
     */
    public function paginate(string $keyword = null, int $page, int $perPage) {
        $currentPage = $page - 1;
        $currentItem = $currentPage * $perPage;


        $departments = $this->deptRepo->findAll([], $perPage, $currentItem);

        $paginator = new Paginator($departments, $perPage, $currentPage);

        return $paginator;

        /* $models = $this->departmentRepo->all($page, $perPage * ($page - 1));

          $departments = [];
          foreach ($models as $model) {
          $departments[] = $model->toArray();
          }

          return $departments; */
    }

    /**
     * 
     * @return type
     */
    public function totalCount() {
        return ceil($this->deptRepo->count());
    }

    public function getOne() {
        
    }

    public function prepareResponse() {
        
    }

}
