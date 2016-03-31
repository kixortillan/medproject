<?php

namespace App\Libraries\Repositories\Core\Exceptions;

use Exception;

class DiseaseNotFoundException extends Exception {

    public function __construct() {
        $this->message = 'Disease not found.';
    }

}
