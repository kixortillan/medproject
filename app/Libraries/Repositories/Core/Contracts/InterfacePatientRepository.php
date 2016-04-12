<?php

namespace App\Libraries\Repositories\Core\Contracts;

use App\Models\Core\Patient;

interface InterfacePatientRepository {

    public function get($id);

    public function all();

    public function save(Patient $patient);
}
