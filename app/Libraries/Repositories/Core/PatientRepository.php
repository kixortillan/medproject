<?php

namespace App\Libraries\Repositories\Core;

use App\Libraries\Repositories\Core\Contracts\InterfacePatientRepository;
use App\Libraries\Repositories\Core\BaseRepository;
use App\Models\Core\Patient;

class PatientRepository extends BaseRepository implements InterfacePatientRepository {

    public function __construct() {
        parent::__construct();
        $this->mainTable = 'patients';
    }

    public function get($id) {
        
    }

    public function all() {
        $records = DB::table($this->mainTable)
                ->orderBy('created_at')
                ->get();

        $model = [];
        foreach ($records as $record) {
            $temp = new Patient;
            $temp->setId($record->id);
            $temp->setFirstName($record->first_name);
            $temp->setMiddleName($record->middle_name);
            $temp->setLastName($record->last_name);
            $temp->setAddress($record->address);
            $temp->setPostalCode($record->postal_code);
            $models[] = $temp;
        }

        return $models;
    }

    public function save(Patient $patient) {
        
    }

}
