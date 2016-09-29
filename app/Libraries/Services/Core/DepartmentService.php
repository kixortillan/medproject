<?php

namespace App\Libraries\Services\Core;

use App\Libraries\Repositories\Core\Contracts\InterfaceDepartmentRepository;
use App\Libraries\Services\Core\Contracts\InterfaceDepartmentService;
use App\Libraries\Common\ValueObjects\SearchCriteria;
use League\Fractal\Pagination\Cursor;

class DepartmentService implements InterfaceDepartmentService {

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
    public function paginate(int $page, int $perPage, string $keyword = null) {
        $currentPage = $page - 1;
        
        //$currentItem = $currentPage * $perPage;

        $departments = $this->deptRepo->findAll(new SearchCriteria($perPage, $page, 'created_at', 'asc', [], $keyword));

        //$paginator = new Paginator($departments, $perPage, $currentPage);

        $cursor = new Cursor($perPage, $departments->first()->getCode(), $departments->last()->getCode(), $this->deptRepo->count());

        $resource = new \League\Fractal\Resource\Collection($departments, new \App\Libraries\Transformers\Core\DepartmentTranformer());

        $resource->setCursor($cursor);

        return $resource;

        /* $models = $this->departmentRepo->all($page, $perPage * ($page - 1));

          $departments = [];
          foreach ($models as $model) {
          $departments[] = $model->toArray();
          }

          return $departments; */
    }

    public function departmentDetails(string $code) {
        $department = $this->deptRepo->findByCode($code);
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
