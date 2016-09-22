<?php

namespace App\Libraries\Mappings\Core;

use App\Libraries\Entities\Core\Diagnosis;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;

class DiagnosisMapping extends EntityMapping {

    public function map(Fluent $builder) {
        $builder->table('diagnoses');
        $builder->bigIncrements('id');
        $builder->text('name');
        $builder->text('desc')->nullable();
        $builder->dateTime('createdAt')->columnName('created_at');
        $builder->dateTime('updatedAt')->columnName('updated_at');
        $builder->dateTime('deletedAt')->columnName('deleted_at');
    }

    public function mapFor() {
        return Diagnosis::class;
    }

}
