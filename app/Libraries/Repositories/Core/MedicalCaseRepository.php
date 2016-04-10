<?php

namespace App\Libraries\Repositories\Core;

use App\Libraries\Repositories\Core\Contracts\InterfaceMedicalCaseRepository;
use App\Libraries\Repositories\Core\BaseRepository;
use App\Models\Core\MedicalCase;
use DB;

class MedicalCaseRepository extends BaseRepository implements InterfaceMedicalCaseRepository {

    public function __construct() {
        parent::__construct();
        $this->mainTable = "medical_cases";
    }

    public function get() {
        try {
            $records = DB::table($this->mainTable)
                    ->get();
        } catch (Exception $ex) {
            
        }
    }

    public function all() {
        try {
            $records = DB::table($this->mainTable)
                    ->get();

            $model = [];

            foreach ($records as $record) {
                $tempModel = new MedicalCase();
                $tempModel->setId($record->id);
                $tempModel->setSerialNo($record->serial_no);
                $models[] = $tempModel;
            }

            return $models;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function save(MedicalCase $medicalCase) {
        
    }

}
