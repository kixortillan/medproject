<?php

namespace App\Http\Controllers\Core;

use App\Libraries\Repositories\Core\DiagnosisRepository;
use App\Http\Controllers\Controller;
use App\Models\Entity\Department;
use Illuminate\Http\Request;
use Exception;

class DiagnosisController extends Controller {

    protected $diagnosisRepo;

    public function __construct() {
        $this->diagnosisRepo = new DiagnosisRepository();
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
            $models = $this->diagnosisRepo
                    ->search(['name', 'desc'], $search);

            $diagnoses = [];
            foreach ($models as $diagnosis) {
                $diagnoses[] = $diagnosis->toArray();
            }

            $this->setData('diagnoses', $diagnoses);
        } catch (Exception $ex) {
            throw $ex;
        }

        return response()->json($this->getResponseBag());
    }

}
