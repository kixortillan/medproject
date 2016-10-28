<?php

namespace App\Libraries\Mappings\Core;

use App\Libraries\Entities\Core\MedicalCase;
use App\Libraries\Entities\Core\Department;
use LaravelDoctrine\Fluent\EntityMapping;
use App\Libraries\Entities\Core\MedicalCasePatient;
use LaravelDoctrine\Fluent\Fluent;

class MedicalCaseMapping extends EntityMapping {

    public function map(Fluent $builder) {
        $builder->table('medical_cases');
        $builder->bigIncrements('id')->columnName('id');
        $builder->text('serialNum')->columnName('serial_num');
        $builder->dateTime('createdAt')->columnName('created_at');
        $builder->dateTime('updatedAt')->columnName('updated_at');
        $builder->dateTime('deletedAt')->columnName('deleted_at');

        //$builder->manyToMany(Department::class)->mappedBy('departments')->cascadePersist();
        //$builder->oneToOne(\App\Libraries\Entities\Core\Patient::class, 'patient');
        $builder->oneToMany(MedicalCasePatient::class, 'medicalCasePatient')
                ->mappedBy('medicalCase');
    }

    public function mapFor() {
        return MedicalCase::class;
    }

}
