<?php

namespace App\Http\Controllers\Core;

use App\Libraries\Repositories\Core\MedicalCaseRepository;
use App\Libraries\Repositories\Core\DepartmentRepository;
use App\Libraries\Repositories\Core\DiagnosisRepository;
use App\Libraries\Repositories\Core\PatientRepository;
use App\Http\Controllers\Controller;
use App\Models\Core\MedicalCase;
use App\Models\Core\Department;
use App\Models\Core\Diagnosis;
use Illuminate\Http\Request;
use Exception;

class MedicalCaseController extends Controller {

    protected $medicalCaseRepo;
    protected $deptRepo;
    protected $patientRepo;
    protected $diagnosisRepo;

    public function __construct() {
        $this->medicalCaseRepo = new MedicalCaseRepository();
        $this->deptRepo = new DepartmentRepository();
        $this->patientRepo = new PatientRepository();
        $this->diagnosisRepo = new DiagnosisRepository();
    }

    public function index(Request $request, $id = null) {
        if (is_null($id)) {
            $model = $this->medicalCaseRepo->get($id);
        } else {
            $this->medicalCaseRepo->all();
        }

        return response()->json($this->getResponseBag());
    }

    public function store(Request $request) {
        $serialNum = $request->input('serial_num', null);
        $patientId = $request->input('patient_id', null);
        $departments = $request->input('departments', null);
        $diagnosis = $request->input('diagnosis');

        try {
            $this->validate($request, [
                'serial_num' => 'bail|required',
                'patient_id' => 'bail|required|array',
                'departments' => 'bail|required|array',
                'diagnosis' => 'bail|array',
            ]);
        } catch (Exception $ex) {
            throw $ex;
        }

        $medicalCase = new MedicalCase();
        $medicalCase->setSerialNum($serialNum);

        foreach ($departments as $val) {
            $matchedDepartment = $this->deptRepo->search(['name'], $val);

            if (empty($matchedDepartment)) {
                $newDepartment = new Department();
                $newDepartment->setName($val);
                $toAddDepartment = $this->deptRepo->save($newDepartment);
            } else {
                $toAddDepartment = head($matchedDepartment);
            }
            $medicalCase->addDepartment($toAddDepartment);
        }

        foreach ($patientId as $val) {
            $medicalCase->addPatient($this->patientRepo->get($val));
        }

        foreach ($diagnosis as $val) {
            $matchedDiagnosis = $this->diagnosisRepo->search(['name'], $val);

            if (empty($matchedDiagnosis)) {
                $newDiagnosis = new Diagnosis();
                $newDiagnosis->setName($val);
                $toAddDiagnosis = $this->diagnosisRepo->save($newDiagnosis);
            } else {
                $toAddDiagnosis = head($matchedDiagnosis);
            }
            $medicalCase->addDiagnoses($toAddDiagnosis);
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
