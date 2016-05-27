<?php

namespace App\Libraries\Repositories\Core;

use App\Libraries\Repositories\Core\Contracts\InterfaceMedicalCaseRepository;
use App\Libraries\Repositories\Core\BaseRepository;
use App\Models\Core\MedicalCase;
use App\Models\Core\Department;
use App\Models\Core\Diagnosis;
use App\Models\Core\Patient;
use DB;

class MedicalCaseRepository extends BaseRepository implements InterfaceMedicalCaseRepository {

    protected $deptTable;
    protected $diagnosesTable;
    protected $patientsTable;
    protected $mapDeptsTable;
    protected $mapPatientsTable;
    protected $mapDiagnosesTable;
    protected $result;

    public function __construct() {
        parent::__construct();
        $this->mainTable = "medical_cases";
        $this->deptTable = "departments";
        $this->diagnosesTable = "diagnoses";
        $this->patientsTable = "patients";
        $this->mapDeptsTable = "medical_case_departments";
        $this->mapPatientsTable = "medical_case_patients";
        $this->mapDiagnosesTable = "medical_case_diagnoses";
    }

    public function withDepartments() {
        $this->initBuilder();

        $this->builder->join($this->mapDeptsTable
                , "{$this->mapDeptsTable}.medical_case_id"
                , "="
                , "{$this->mainTable}.id");

        $this->builder->join($this->deptTable
                , "{$this->deptTable}.id"
                , "="
                , "{$this->mapDeptsTable}.department_id");

        if (is_array($this->result)) {
            $this->builder->whereIn('medical_case_id', array_keys($this->result));
        } else {
            $this->builder->where('medical_case_id', $this->result->getId());
        }

        $records = $this->builder->get();

        if (is_array($this->result)) {
            foreach ($records as $record) {
                $temp = new Department();
                $temp->setId($record->id);
                $temp->setCode($record->code);
                $temp->setName($record->name);
                $temp->setDesc($record->desc);

                $this->result[$record->medical_case_id]
                        ->addDepartment($temp);
            }
        } else {
            foreach ($records as $record) {
                $temp = new Department();
                $temp->setId($record->id);
                $temp->setCode($record->code);
                $temp->setName($record->name);
                $temp->setDesc($record->desc);

                $this->result->addDepartment($temp);
            }
        }

        return $this;
    }

    public function withDiagnoses() {
        $this->initBuilder();

        $this->builder->join($this->mapDiagnosesTable
                , "{$this->mapDiagnosesTable}.medical_case_id"
                , "="
                , "{$this->mainTable}.id");

        $this->builder->join($this->diagnosesTable
                , "{$this->diagnosesTable}.id"
                , "="
                , "{$this->mapDiagnosesTable}.diagnosis_id");

        if (is_array($this->result)) {
            $this->builder->whereIn('medical_case_id', array_keys($this->result));
        } else {
            $this->builder->where('medical_case_id', $this->result->getId());
        }

        $records = $this->builder->get();

        if (is_array($this->result)) {
            foreach ($records as $record) {
                $temp = new Diagnosis();
                $temp->setId($record->diagnosis_id);
                $temp->setName($record->name);
                $temp->setDesc($record->desc);

                $this->result[$record->medical_case_id]
                        ->addDiagnoses($temp);
            }
        } else {
            foreach ($records as $record) {
                $temp = new Diagnosis();
                $temp->setId($record->diagnosis_id);
                $temp->setName($record->name);
                $temp->setDesc($record->desc);

                $this->result->addDiagnoses($temp);
            }
        }

        return $this;
    }

    public function withPatients() {
        $this->initBuilder();

        $this->builder->join($this->mapPatientsTable
                , "{$this->mapPatientsTable}.medical_case_id"
                , "="
                , "{$this->mainTable}.id");

        $this->builder->join($this->patientsTable
                , "{$this->patientsTable}.id"
                , "="
                , "{$this->mapPatientsTable}.patient_id");

        if (is_array($this->result)) {
            $this->builder->whereIn('medical_case_id', array_keys($this->result));
        } else {
            $this->builder->where('medical_case_id', $this->result->getId());
        }

        $records = $this->builder->get();

        if (is_array($this->result)) {
            foreach ($records as $record) {
                $temp = new Patient();
                $temp->setId($record->id);
                $temp->setFirstName($record->first_name);
                $temp->setMiddleName($record->middle_name);
                $temp->setLastName($record->last_name);
                $temp->setAddress($record->address);
                $temp->setPostalCode($record->postal_code);
                $temp->setDateRegistered($record->created_at);

                $this->result[$record->medical_case_id]
                        ->addPatient($temp);
            }
        } else {
            foreach ($records as $record) {
                $temp = new Patient();
                $temp->setId($record->id);
                $temp->setFirstName($record->first_name);
                $temp->setMiddleName($record->middle_name);
                $temp->setLastName($record->last_name);
                $temp->setAddress($record->address);
                $temp->setPostalCode($record->postal_code);
                $temp->setDateRegistered($record->created_at);

                $this->result->addPatient($temp);
            }
        }

        return $this;
    }

    public function get() {
        return $this->result;
    }

    public function one($id) {
        try {
            $this->initBuilder();

            $this->builder->where('id', $id)->whereNull('deleted_at');

            $record = $this->builder->first();

            $this->result = new MedicalCase();

            $this->result->setId($record->id);
            $this->result->setSerialNum($record->serial_num);

            return $this;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function all($limit = null, $offset = null) {
        try {
            $this->initBuilder();

            if (isset($limit)) {
                $this->builder->limit($limit);
            }

            if (isset($offset)) {
                $this->builder->skip($offset);
            }

            $records = $this->builder->whereNull('deleted_at')->get();

            $this->result = [];

            foreach ($records as $record) {
                $tempModel = new MedicalCase();
                $tempModel->setId($record->id);
                $tempModel->setSerialNum($record->serial_num);

                $this->result[$tempModel->getId()] = $tempModel;
            }

            return $this;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function save(MedicalCase $medicalCase) {
        if (is_null($medicalCase->getId())) {
            $medicalCase = $this->saveMedicalCase($medicalCase);
        } else {
            $this->updateMedicalCase($medicalCase);
        }

        return $medicalCase;
    }

    public function count() {
        try {
            return DB::table($this->mainTable)
                            ->whereNull('deleted_at')
                            ->count();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    private function saveMedicalCase(MedicalCase $medicalCase) {
        DB::transaction(function() use($medicalCase) {
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
        });
        
        return $medicalCase;
    }

    private function updateMedicalCase(MedicalCase $medicalCase) {
        DB::transaction(function() use($medicalCase) {
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
        });
    }

}
