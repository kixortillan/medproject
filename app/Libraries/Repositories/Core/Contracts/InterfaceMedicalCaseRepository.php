<?php

namespace App\Libraries\Repositories\Core\Contracts;

use App\Libraries\Repositories\Core\Contracts\InterfaceRepository;
use App\Models\Entity\MedicalCase;

interface InterfaceMedicalCaseRepository extends InterfaceRepository {

    /**
     * 
     * @param MedicalCase $model
     */
    public function save(MedicalCase $model);
}
