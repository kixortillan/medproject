<?php

namespace App\Libraries\Repositories\Core\Contracts;

use App\Libraries\Entities\Core\Department;

interface InterfaceDepartmentRepository {

    /**
     * 
     * @param Department $model
     */
    public function save(Department $model);

    /**
     * 
     * @param int $id
     */
    public function delete(int $id);

    /**
     * 
     * @param string $code
     */
    public function findByCode(string $code);

    /**
     * 
     * @param int $limit
     * @param int $offset
     */
    public function findAll(array $criteria, $limit, $offset = 0, $orderBy = 'id');

    /**
     * 
     */
    public function count();

    /**
     * 
     * @param type $columns
     * @param type $keyword
     */
    public function search($columns, $keyword);
}
