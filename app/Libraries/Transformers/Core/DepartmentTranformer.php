<?php

namespace App\Libraries\Transformers\Core;

use App\Libraries\Entities\Core\Department;
use League\Fractal\TransformerAbstract;

class DepartmentTranformer extends TransformerAbstract {

    public function transform(Department $dept) {
        return [
            'id' => $dept->getCode(),
            'name' => $dept->getName(),
            'description' => $dept->getDescription(),
        ];
    }

}
