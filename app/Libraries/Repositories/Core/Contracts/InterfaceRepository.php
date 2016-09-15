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
    public function one(int $id);

    /**
     * 
     * @param int $limit
     * @param int $offset
     */
    public function all(int $limit = null, int $offset = null);

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
