<?php

namespace App\Libraries\Mappings\Core;

use App\Libraries\Entities\Core\MedicalCase;
use LaravelDoctrine\Fluent\EntityMapping;
use App\Libraries\Entities\Core\MedicalCasePatient;
use App\Libraries\Entities\Core\Patient;
use LaravelDoctrine\Fluent\Fluent;

class MedicalCasePatientMapping extends EntityMapping {

    public function map(Fluent $builder) {
        $builder->table('medical_case_patient');
        $builder->bigIncrements('id');
        $builder->bigInteger('medicalCaseId')->columnName('medical_case_id');
        $builder->bigInteger('patientId')->columnName('patient_id');
        $builder->dateTime('createdAt')->columnName('created_at');
        $builder->dateTime('updatedAt')->columnName('updated_at');
        $builder->dateTime('deletedAt')->columnName('deleted_at');

        $builder->manyToOne(Patient::class)
                ->addJoinColumn('patient_id', 'medical_case_id', false)
                ->inversedBy('medicalCasePatient')
                ->fetchEager()
                ->cascadePersist();

        $builder->manyToOne(MedicalCase::class)
                ->addJoinColumn('medical_case_id', 'patient_id', false)
                ->inversedBy('medicalCasePatient')
                ->fetchEager()
                ->cascadePersist();

        //$builder->manyToMany(Department::class)->mappedBy('departments')->cascadePersist();
    }

    public function mapFor() {
        return MedicalCasePatient::class;
    }

}
