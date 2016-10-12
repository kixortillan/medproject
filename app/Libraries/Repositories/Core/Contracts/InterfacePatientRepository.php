<?php

namespace App\Libraries\Repositories\Core\Contracts;

use App\Libraries\Entities\Core\Patient;
use App\Libraries\Common\ValueObjects\SearchCriteria;

interface InterfacePatientRepository {

    /**
     * 
     * @param Patient $model
     */
    public function save(Patient $model);

    /**
     * 
     * @param int $id
     */
    public function delete($id);

    /**
     * 
     * @param int $id
     */
    public function findById($id);

    /**
     * 
     * @param SearchCriteria $search
     */
    public function findAll(SearchCriteria $search);

    /**
     * 
     */
    public function count();
}
