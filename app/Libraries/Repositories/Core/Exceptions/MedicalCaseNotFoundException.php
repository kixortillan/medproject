<?php

namespace App\Libraries\Repositories\Core\Exceptions;

use Exception;

class MedicalCaseNotFoundException extends Exception {

    public function __construct() {
        $this->message = 'Medical case not found.';
    }

}
