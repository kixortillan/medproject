<?php

namespace App\Http\Controllers\Core;

use App\Libraries\Repositories\Core\MedicalCaseRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class MedicalCaseController extends Controller {

    protected $medicalCaseRepo;

    public function __construc() {
        $this->medicalCaseRepo = new MedicalCaseRepository();
    }

    public function index() {
        
    }

    public function store(Request $request) {
        $patientId = $request->input('patient_id', null);
        $departmentId = $request->input('department_id', null);

        try {
            $this->validate($request, [
                'patient_id' => 'bail|required|numeric',
                'department_id' => 'bail|required|numeric',
            ]);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function edit() {
        
    }

    public function delete() {
        
    }

}
