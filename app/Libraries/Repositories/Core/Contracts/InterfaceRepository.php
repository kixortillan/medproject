<?php

namespace App\Libraries\Repositories\Core\Contracts;

interface InterfaceRepository {

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
     */
    public function count();

    /**
     * 
     * @param string $keyword
     * @param array $columns
     */
    public function search($keyword = null, array $columns = []);
}
