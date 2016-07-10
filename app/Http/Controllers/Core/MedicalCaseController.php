<?php

namespace App\Http\Controllers\Core;

use App\Libraries\Repositories\Core\MedicalCaseRepository;
use App\Libraries\Repositories\Core\DepartmentRepository;
use App\Libraries\Repositories\Core\DiagnosisRepository;
use App\Libraries\Repositories\Core\PatientRepository;
use App\Http\Controllers\Controller;
use App\Models\Entity\MedicalCase;
use App\Models\Entity\Department;
use App\Models\Entity\Diagnosis;
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
        $pageNum = $request->query('page', 1);
        $limit = $request->query('per_page', 5);
        $models = null;

        if (is_null($id)) {
            $models = $this->medicalCaseRepo
                    ->all($limit, $limit * ($pageNum - 1))
                    ->get();
        } else {
            $models = $this->medicalCaseRepo
                    ->one($id)
                    ->withDepartments()
                    ->withPatients()
                    ->withDiagnoses()
                    ->get();
        }

        if (is_array($models)) {
            $medicalCases = [];

            foreach ($models as $case) {
                $medicalCases[] = $case->toArray();
            }

            $this->setData('medical_cases', $medicalCases);
            $this->addItem('total', $this->medicalCaseRepo->count());
            $this->addItem('per_page', $limit);
        } else {
            $this->setData('medical_case', $models->toArray());
        }

        $this->setType(MedicalCase::getModelName());

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
            $matchedDepartment = $this->deptRepo->get($val);

            $medicalCase->addDepartment($matchedDepartment);
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

    public function edit(Request $request, $id) {
        
    }

    public function delete() {
        
    }

}
