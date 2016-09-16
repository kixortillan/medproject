<?php

namespace App\Libraries\Mappings\Core;

use App\Libraries\Entities\Core\Department;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;

class DepartmentMapping extends EntityMapping {

    public function map(Fluent $builder) {
        $builder->string('code');
        $builder->string('name');
        $builder->string('desc')->nullable();
        $builder->dateTime('createdAt')->columnName('created_at');
        $builder->dateTime('updatedAt')->columnName('updated_at');
        $builder->dateTime('deletedAt')->columnName('deleted_at');
        $builder->primary('code');
    }

    public function mapFor() {
        return Department::class;
    }

}
