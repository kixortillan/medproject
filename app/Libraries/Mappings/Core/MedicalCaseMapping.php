<?php

namespace App\Libraries\Mappings\Core;

use App\Libraries\Entities\Core\MedicalCase;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;

class MedicalCaseMapping extends EntityMapping {

    public function map(Fluent $builder) {
        $builder->table('medical_cases');
        $builder->bigIncrements('id');
        $builder->text('serialNum')->columnName('serial_num');
        $builder->dateTime('createdAt')->columnName('created_at');
        $builder->dateTime('updatedAt')->columnName('updated_at');
        $builder->dateTime('deletedAt')->columnName('deleted_at');
    }

    public function mapFor() {
        return MedicalCase::class;
    }

}
