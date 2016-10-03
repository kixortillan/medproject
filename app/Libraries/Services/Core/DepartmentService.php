<?php

namespace App\Libraries\Services\Core;

use App\Libraries\Repositories\Core\Contracts\InterfaceDepartmentRepository;
use App\Libraries\Services\Core\Contracts\InterfaceDepartmentService;
use App\Libraries\Common\ValueObjects\SearchCriteria;
use League\Fractal\Pagination\Cursor;

class DepartmentService implements InterfaceDepartmentService {

    /**
     *
     * @var InterfaceDepartmentRepository 
     */
    protected $deptRepo;

    /**
     *
     * @var string 
     */
    protected $type = 'departments';

    public function __construct(InterfaceDepartmentRepository $deptRepo) {
        $this->deptRepo = $deptRepo;
    }

    /**
     * 
     * @param int $page
     * @param int $perPage
     * @return Paginator
     */
    public function paginate($page, $perPage, $columns = [], $keyword = null) {
        $currentPage = $page - 1;

        $departments = $this->deptRepo->findAll(new SearchCriteria($currentPage, $perPage, 'createdAt', 'asc', $columns, $keyword));

        if ($departments->count() == 0) {
            return null;
        }

        $resource = new \League\Fractal\Resource\Collection($departments, new \App\Libraries\Transformers\Core\DepartmentTranformer(), $this->type);

        $first = $departments->count() > 0 ? $departments->first()->getCode() : null;
        $last = $departments->count() > 0 ? $departments->last()->getCode() : null;

        $cursor = new Cursor($perPage, $first, $last, $this->deptRepo->count());

        $resource->setCursor($cursor);

        return $resource;
    }

    /**
     * 
     * @param type $code
     */
    public function departmentDetails($code) {
        $department = $this->deptRepo->findByCode($code);

        if ($department == null) {
            return null;
        }

        $resource = new \League\Fractal\Resource\Item($department, new \App\Libraries\Transformers\Core\DepartmentTranformer(), $this->type);

        return $resource;
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
