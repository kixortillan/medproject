<?php

namespace App\Libraries\Repositories\Core;

use App\Libraries\Repositories\Core\Contracts\InterfaceMedicalCaseRepository;
use App\Libraries\Repositories\Core\BaseRepository;
use App\Models\Core\MedicalCase;
use DB;

class MedicalCaseRepository extends BaseRepository implements InterfaceMedicalCaseRepository {

    protected $deptTable;
    protected $diagnosesTable;
    protected $patientsTable;
    protected $mapDeptsTable;
    protected $mapPatientsTable;
    protected $mapDiagnosesTable;
    protected $builder;
    protected $model;
    protected $models;

    public function __construct() {
        parent::__construct();
        $this->mainTable = "medical_cases";
        $this->deptTable = "departments";
        $this->diagnosesTable = "diagnoses";
        $this->patientsTable = "patients";
        $this->mapDeptsTable = "medical_case_departments";
        $this->mapPatientsTable = "medical_case_patients";
        $this->mapDiagnosesTable = "medical_case_diagnoses";
        $this->builder = DB::table($this->mainTable);
    }

    public function withAll() {
        try {
            $this->builder = DB::table($this->mainTable)
                    ->join($this->mapDeptsTable
                            , "{$this->mapDeptsTable}.medical_case_id"
                            , "="
                            , "{$this->mainTable}.id")
                    ->join($this->deptTable
                            , "{$this->deptTable}.id"
                            , "="
                            , "{$this->mapDeptsTable}.department_id"
                    )
                    ->join($this->mapDiagnosesTable
                            , "{$this->mapDiagnosesTable}.medical_case_id"
                            , "="
                            , "{$this->mainTable}.id")
                    ->join($this->diagnosesTable
                    , "{$this->diagnosesTable}.id"
                    , "="
                    , "{$this->mapDiagnosesTable}.diagnosis_id"
            );
            return $this;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function withDepartments() {
        $this->builder->join($this->mapDeptsTable
                , "{$this->mapDeptsTable}.medical_case_id"
                , "="
                , "{$this->mainTable}.id");

        return $this;
    }

    public function withDiagnoses() {
        $this->builder->join($this->mapDiagnosesTable
                , "{$this->mapDiagnosesTable}.medical_case_id"
                , "="
                , "{$this->mainTable}.id");

        return $this;
    }

    public function withPatients() {
        
    }

    public function get($id) {
        try {
            $this->builder->where('id', $id);

            $record = $this->builder->first();

            $this->model = new MedicalCase();

            $this->model->setId($record->id);
            $this->model->setSerialNum($record->serial_num);

            return $this->model;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function all() {
        try {
            $records = $this->builder->get();

            $models = [];

            foreach ($records as $record) {
                if(!key_exists($record->id, $models)){
                    $tempModel = new MedicalCase();
                    $tempModel->setId($record->id);
                    $tempModel->setSerialNo($record->serial_no);
                    $models[] = $tempModel;
                }
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
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }

        DB::table($this->mapDeptsTable)
                ->insert($insertMedCaseDept);

        $insertMedCasePatients = [];

        foreach ($medicalCase->getPatients() as $item) {
            $insertMedCasePatients[] = [
                'medical_case_id' => $medicalCase->getId(),
                'patient_id' => $item->getId(),
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }

        DB::table($this->mapPatientsTable)
                ->insert($insertMedCasePatients);

        $insertMedCaseDiagnoses = [];

        foreach ($medicalCase->getDiagnoses() as $item) {
            $insertMedCaseDiagnoses[] = [
                'medical_case_id' => $medicalCase->getId(),
                'diagnosis_id' => $item->getId(),
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }

        DB::table($this->mapDiagnosesTable)
                ->insert($insertMedCaseDiagnoses);

        return $medicalCase;
    }

}
