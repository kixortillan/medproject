<?php

namespace App\Http\Controllers\Core;

use App\Libraries\Repositories\Core\PatientRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Core\Patient;
use Exception;

class PatientController extends Controller {

    protected $patientRepo;

    public function __construct() {
        $this->patientRepo = new PatientRepository();
    }

    public function index(Request $request, $id = null) {
        try {
            if (!is_null($id)) {
                $this->setData($this->patientRepo->get($id)->toArray());
            } else {
                foreach ($this->patientRepo->all() as $model) {
                    $this->setData($model->toArray());
                }
            }
            $this->setType(Patient::getModelName());
        } catch (Exception $ex) {
            throw $ex;
        }

        return response()->json($this->getResponseBag());
    }

    public function store(Request $request) {
        try {
            $firstName = $request->input('first_name', null);
            $middleName = $request->input('middle_name', null);
            $lastName = $request->input('last_name', null);

            $patient = new Patient();
            $patient->setFirstName($firstName);
            $patient->setMiddleName($middleName);
            $patient->setLastName($lastName);

            $this->setData($this->patientRepo->save($patient)->toArray());
            $this->setType(Patient::getModelName());

            return response()->json($this->getResponseBag());
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function edit(Request $request, $id) {
        
    }

    public function delete(Request $request, $id) {
        
    }

}
