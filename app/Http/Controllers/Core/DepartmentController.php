<?php

namespace App\Http\Controllers\Core;

use App\Libraries\Repositories\Core\DepartmentRepository;
use App\Http\Controllers\Controller;
use App\Models\Core\Department;
use Illuminate\Http\Request;
use Exception;

class DepartmentController extends Controller {

    protected $departmentRepo;

    public function __construct() {
        $this->departmentRepo = new DepartmentRepository();
    }

    public function index(Request $request, $id = null) {
        try {
            if ($id != null) {
                $this->departmentRepo->get($id);
            } else {
                $models = $this->departmentRepo->all();

                $response = [];
                foreach ($models as $model) {
                    $response[] = $model->toArray();
                }

                return response()->json($response);
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function store(Request $request) {
        try {
            $code = $request->get('code', null);
            $name = $request->get('name', null);
            $desc = $request->get('desc', null);
        } catch (Exception $ex) {
            throw $ex;
        }

        try {
            $model = new Department();
            $model->setCode($code);
            $model->setName($name);
            $model->setDesc($desc);

            $model = $this->departmentRepo->save($model);

            return response()->json($model->toArray());
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function edit(Request $request, $id) {
        try {
            $code = $request->get('code', null);
            $name = $request->get('name', null);
            $desc = $request->get('desc', null);
        } catch (Exception $ex) {
            throw $ex;
        }

        try {
            $model = new Department();
            $model->setCode($code);
            $model->setName($name);
            $model->setDesc($desc);

            $model = $this->departmentRepo->save($model);

            return response()->json($model->toArray());
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function delete(Request $request, $id) {
        try {
            $this->departmentRepo->delete($id);
            
            return response()->json();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getWithDiseases(Request $request, $id, $diseaseId = null) {
        
    }

}
