<?php

namespace App\Libraries\Repositories\Core\Exceptions;

use Exception;

class PatientNotFoundException extends Exception {

    public function __construct() {
        $this->message = 'Patient not found.';
    }

}
