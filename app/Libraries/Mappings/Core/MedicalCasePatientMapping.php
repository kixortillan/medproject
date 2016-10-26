<?php

namespace App\Libraries\Mappings\Core;

use App\Libraries\Entities\Core\MedicalCase;
use App\Libraries\Entities\Core\Department;
use LaravelDoctrine\Fluent\EntityMapping;
use App\Libraries\Entities\Core\MedicalCasePatient;
use App\Libraries\Entities\Core\Patient;
use App\Libraries\Entities\Core\MedicalCase;
use LaravelDoctrine\Fluent\Fluent;

class MedicalCasePatientMapping extends EntityMapping {

    public function map(Fluent $builder) {
        $builder->table('medical_case_patient');
        $builder->bigInteger('medical_case_id');
        $builder->bigInteger('patient_id');
        //$builder->dateTime('createdAt')->columnName('created_at');
        //$builder->dateTime('updatedAt')->columnName('updated_at');
        //$builder->dateTime('deletedAt')->columnName('deleted_at');

        $builder->manyToOne(Patient::class)
                ->mappedBy('patient')
                ->fetchEager()
                ->cascadePersist();

        $builder->manyToOne(MedicalCase::class)
                ->mappedBy('medicalCase')
                ->fetchEager()
                ->cascadePersist();

        //$builder->manyToMany(Department::class)->mappedBy('departments')->cascadePersist();
    }

    public function mapFor() {
        return MedicalCasePatient::class;
    }

}
