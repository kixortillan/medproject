<?php

namespace App\Libraries\Repositories\Core\Contracts;

interface InterfaceRepository {

    /**
     * 
     * @param int $id
     */
    public function delete(int $id);

    /**
     * 
     * @param int $id
     */
    public function findById(int $id);

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
