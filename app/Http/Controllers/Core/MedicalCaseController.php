<?php

namespace App\Http\Controllers\Core;

use App\Libraries\Repositories\Core\MedicalCaseRepository;
use App\Libraries\Repositories\Core\DepartmentRepository;
use App\Libraries\Repositories\Core\DiagnosisRepository;
use App\Libraries\Repositories\Core\PatientRepository;
use App\Http\Controllers\Controller;
use App\Models\Core\MedicalCase;
use Illuminate\Http\Request;
use Exception;

class MedicalCaseController extends Controller {

    protected $medicalCaseRepo;
    protected $deptRepo;
    protected $patientRepo;
    protected $diagnosisRepo;

    public function __construc() {
        $this->medicalCaseRepo = new MedicalCaseRepository();
        $this->deptRepo = new DepartmentRepository();
        $this->patientRepo = new PatientRepository();
        $this->diagnosisRepo = new DiagnosisRepository();
    }

    public function index() {
        
    }

    public function store(Request $request) {
        $serialNum = $request->input('serial_num', null);
        $patientId = $request->input('patient_id', null);
        $departmentId = $request->input('department_id', null);
        $diagnosis = $request->input('diagnosis');

        try {
            $this->validate($request, [
                'serial_num' => 'bail|required|alpha_num',
                'patient_id' => 'bail|required|numeric|array',
                'department_id' => 'bail|required|numeric|array',
                'diagnosis' => 'bail|array',
            ]);
        } catch (Exception $ex) {
            throw $ex;
        }

        $medicalCase = new MedicalCase();
        $medicalCase->setSerialNum($serialNum);

        foreach ($departmentId as $val) {
            $medicalCase->addDepartment($this->deptRepo->get($val));
        }

        foreach ($patientId as $val) {
            $medicalCase->addPatient($this->patientRepo->get($val));
        }

        foreach ($diagnosis as $val) {
            $matchedDiagnosis = $this->diagnosisRepo->search(['name' => $val]);
            if (empty($matchedDiagnosis)) {
                $this->diagnosisRepo->save((new \App\Models\Core\Diagnosis)->setName($diagnosis));
            }
            $medicalCase->addDiagnoses(head($models));
        }

        $medicalCase = $this->medicalCaseRepo->save($medicalCase);

        $this->setData('medical_case', $medicalCase->toArray());

        return response()->json($this->getResponseBag());
    }

    public function edit() {
        
    }

    public function delete() {
        
    }

}
