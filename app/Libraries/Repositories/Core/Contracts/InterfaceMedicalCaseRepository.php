<?php

namespace App\Libraries\Repositories\Core\Contracts;

use App\Libraries\Common\ValueObjects\SearchCriteria;
use App\Libraries\Entities\Core\MedicalCase;

interface InterfaceMedicalCaseRepository {

    /**
     * 
     * @param MedicalCase $model
     */
    public function save(MedicalCase $model);

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
