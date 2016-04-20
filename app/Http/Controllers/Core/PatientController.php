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
                $this->setData('patient', $this->patientRepo->get($id)->toArray());
            } else {
                $page = $request->query('page', 1);
                $limit = $request->query('per_page', 5);

                $patients = [];
                foreach ($this->patientRepo->all($limit, $limit * ($page - 1)) as $model) {
                    $patients[] = $model->toArray();
                }

                $this->setData('patients', $patients);
                $this->addItem('total', ceil($this->patientRepo->count() / $limit));
                $this->addItem('per_page', $limit);
            }
            $this->setType(Patient::getModelName());
        } catch (Exception $ex) {
            throw $ex;
        }

        return response()->json($this->getResponseBag());
    }

    public function store(Request $request) {
        $firstName = $request->input('first_name', null);
        $middleName = $request->input('middle_name', null);
        $lastName = $request->input('last_name', null);

        try {
            $this->validate($request, [
                'first_name' => 'bail|required|alpha',
                'middle_name' => 'bail|alpha',
                'last_name' => 'bail|required|alpha',
            ]);
        } catch (Exception $ex) {
            throw $ex;
        }

        try {
            $patient = new Patient();
            $patient->setFirstName(ucwords($firstName));
            $patient->setMiddleName(ucwords($middleName));
            $patient->setLastName(ucwords($lastName));

            $this->setData('patient', $this->patientRepo->save($patient)->toArray());
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
