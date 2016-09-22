<?php

namespace App\Libraries\Mappings\Core;

use App\Libraries\Entities\Core\Department;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;

class DepartmentMapping extends EntityMapping {

    public function map(Fluent $builder) {
        $builder->table('departments');
        $builder->string('code')->columnName('code');
        $builder->string('name')->columnName('name');
        $builder->string('description')->columnName('description')->nullable();
        $builder->dateTime('createdAt')->columnName('created_at');
        $builder->dateTime('updatedAt')->columnName('updated_at');
        $builder->dateTime('deletedAt')->columnName('deleted_at');
        $builder->primary('code');
    }

    public function mapFor() {
        return Department::class;
    }

}
