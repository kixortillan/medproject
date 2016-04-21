<?php

namespace App\Libraries\Repositories\Core;

use App\Libraries\Repositories\Core\Contracts\InterfaceMedicalCaseRepository;
use App\Libraries\Repositories\Core\BaseRepository;
use App\Models\Core\MedicalCase;
use DB;

class MedicalCaseRepository extends BaseRepository implements InterfaceMedicalCaseRepository {

    protected $mapDeptsTable;
    protected $mapPatientsTable;

    public function __construct() {
        parent::__construct();
        $this->mainTable = "medical_cases";
        $this->mapDeptsTable = "medical_case_departments";
        $this->mapPatientsTable = "medical_case_patients";
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
        $id = DB::table($this->mainTable)->insertGetId([
            'serial_num' => $medicalCase->getSerialNum(),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $medicalCase->setId($id);

        $insertMedCaseDept = [];

        foreach ($medicalCase->getDepartments() as $item) {
            $insertMedCaseDept[] = [
                'medical_case_id' => $medicalCase->getId(),
                'department_id' => $item->getId(),
            ];
        }

        DB::table($this->mapDeptsTable)
                ->insert($insertMedCaseDept);

        $insertMedCasePatients = [];

        foreach ($medicalCase->getPatients() as $item) {
            $insertMedCasePatients[] = [
                'medical_case_id' => $medicalCase->getId(),
                'patient_id' => $item->getId(),
            ];
        }

        DB::table($this->mapPatientsTable)
                ->insert($insertMedCasePatients);

        return $medicalCase;
    }

}
