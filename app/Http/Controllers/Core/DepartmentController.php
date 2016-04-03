<?php

namespace App\Http\Controllers\Core;

use App\Libraries\Repositories\Core\DepartmentRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Core\Department;
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
                $this->departmentRepo->all();
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function store(Request $request) {
        try {
            $name = $request->get('name', null);
            $desc = $request->get('desc', null);
        } catch (Exception $ex) {
            throw $ex;
        }

        try {
            $model = new Department();
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
            $name = $request->get('name', null);
            $desc = $request->get('desc', null);
        } catch (Exception $ex) {
            throw $ex;
        }

        try {
            $model = new Department();
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
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}
