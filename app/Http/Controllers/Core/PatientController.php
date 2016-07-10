<?php

namespace App\Http\Controllers\Core;

use App\Libraries\Repositories\Core\PatientRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entity\Patient;
use Exception;

class PatientController extends Controller {

    protected $patientRepo;

    public function __construct() {
        $this->patientRepo = new PatientRepository();
    }

    public function index(Request $request, $id = null) {
        try {
            if (!is_null($id)) {
                $this->setData('patient', $this->patientRepo->one($id)->get()->toArray());
            } else {
                $page = $request->query('page', 1);
                $perPage = $request->query('per_page', 5);

                $patients = [];
                foreach ($this->patientRepo->all($perPage, $perPage * ($page - 1))->get() as $model) {
                    $patients[] = $model->toArray();
                }

                $this->setData('patients', $patients);
                $this->addItem('total', $this->patientRepo->count());
                $this->addItem('per_page', $perPage);
            }
        } catch (Exception $ex) {
            throw $ex;
        }

        $this->setType(Patient::getModelName());

        return response()->json($this->getResponseBag());
    }

    public function store(Request $request) {
        $firstName = $request->input('first_name', null);
        $middleName = $request->input('middle_name', null);
        $lastName = $request->input('last_name', null);
        $postalCode = $request->input('postal_code', null);

        try {
            $this->validate($request, [
                'first_name' => 'bail|required|alpha',
                'middle_name' => 'bail|alpha',
                'last_name' => 'bail|required|alpha',
                'postal_code' => 'bail|required',
            ]);
        } catch (Exception $ex) {
            throw $ex;
        }

        try {
            $patient = new Patient();
            $patient->setFirstName(ucwords($firstName));
            $patient->setMiddleName(ucwords($middleName));
            $patient->setLastName(ucwords($lastName));
            $patient->setPostalCode($postalCode);
            $this->patientRepo->save($patient);

            $this->setData('patient', $this->patientRepo->get()->toArray());
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

    public function search(Request $request) {
        $search = $request->query('keyword', null);

        try {
            $this->validate($request, [
                'keyword' => 'required'
            ]);
        } catch (Exception $ex) {
            throw $ex;
        }

        try {
            $models = $this->patientRepo
                    ->search(['first_name', 'middle_name', 'last_name'], $search);

            $patients = [];
            foreach ($models as $item) {
                $patients[] = $item->toArray();
            }

            $this->setData('patients', $patients);
        } catch (Exception $ex) {
            throw $ex;
        }

        return response()->json($this->getResponseBag());
    }

}
