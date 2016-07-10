<?php

namespace App\Libraries\Repositories\Core\Contracts;

use App\Models\Entity\Patient;

interface InterfacePatientRepository {

    public function one($id);

    public function all();

    public function save(Patient $patient);
}
