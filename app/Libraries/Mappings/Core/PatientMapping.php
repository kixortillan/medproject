<?php

namespace App\Libraries\Mappings\Core;

use App\Libraries\Entities\Core\Patient;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;

class PatientMapping extends EntityMapping {

    public function map(Fluent $builder) {
        $builder->bigIncrements('id');
        $builder->text('firstName')->columnName('first_name');
        $builder->text('middleName')->columnName('middle_name')->nullable();
        $builder->text('lastName')->columnName('last_name');
        $builder->text('address')->nullable();
        $builder->text('postalCode')->columnName('postal_code');
        $builder->dateTime('createdAt')->columnName('created_at');
        $builder->dateTime('updatedAt')->columnName('updated_at');
        $builder->dateTime('deletedAt')->columnName('deleted_at');
    }

    public function mapFor() {
        return Patient::class;
    }

}
