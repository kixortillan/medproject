<?php

namespace App\Libraries\Repositories\Core\Contracts;

use App\Models\Core\Department;

interface InterfaceDepartmentRepository {

    /**
     * 
     */
    public function get();

    /**
     * 
     * @param type $id
     */
    public function one($id);

    /**
     * 
     * @param type $limit
     * @param type $offset
     */
    public function all($limit = null, $offset = null);

    /**
     * 
     * @param Department $model
     */
    public function save(Department $model);

    /**
     * 
     */
    public function count();

    /**
     * 
     * @param string $keyword
     * @param array $columns
     */
    public function search($keyword = null, array $columns = []);
}
