<?php

namespace App\Libraries\Repositories\Core\Contracts;

use App\Models\Entity\MedicalCase;

interface InterfaceMedicalCaseRepository {

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
     */
    public function all();

    /**
     * 
     * @param MedicalCase $case
     */
    public function save(MedicalCase $case);
    
    /**
     * 
     */
    public function count();
}
