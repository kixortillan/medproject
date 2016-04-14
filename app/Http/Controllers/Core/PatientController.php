<?php

namespace App\Http\Controllers\Core;

use App\Libraries\Repositories\Core\PatientRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class PatientController extends Controller {

    protected $patientRepo;

    public function __construct() {
        $this->patientRepo = new PatientRepository();
    }

    public function index(Request $request, $id = null) {
        try {
            if (!is_null($id)) {
                $this->responseBag[] = $this->patientRepo->get($id)->toArray();
            } else {
                foreach ($this->patientRepo->all() as $model) {
                    $this->responseBag[] = $model->toArray();
                }
            }
        } catch (Exception $ex) {
            throw $ex;
        }

        return response()->json($this->responseBag);
    }

    public function store() {
        
    }

}
