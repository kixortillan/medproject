<?php

namespace App\Libraries\Repositories\Core\Contracts;

use App\Libraries\Repositories\Core\Contracts\InterfaceRepository;
use App\Models\Entity\Patient;

interface InterfacePatientRepository extends InterfaceRepository {

    /**
     * 
     * @param Patient $model
     */
    public function save(Patient $model);
}
