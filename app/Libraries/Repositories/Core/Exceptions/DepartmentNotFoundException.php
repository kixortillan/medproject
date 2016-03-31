<?php

namespace App\Libraries\Repositories\Core\Exceptions;

use Exception;

class DepartmentNotFoundException extends Exception {

    public function __construct() {
        $this->message = 'Department not found.';
    }

}
